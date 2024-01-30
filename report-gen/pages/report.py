import datetime
import sqlite3 as sql

import pandas as pd
import streamlit as st
from reportlab.lib import colors
from reportlab.lib.pagesizes import letter
from reportlab.lib.styles import getSampleStyleSheet
from reportlab.platypus import Paragraph, SimpleDocTemplate, Spacer, Table, TableStyle
from pypdf import PdfMerger

st.set_page_config(
    page_title="Report Generation",
    page_icon="📄",
    layout="centered",
    initial_sidebar_state="auto",
    menu_items=None,
)

st.title("Report Generation")


@st.cache_data
def get_lab_names() -> list[str]:
    """Return the name of all the labs."""
    conn = sql.connect("../database/database.sqlite")
    query = "SELECT lab_name FROM lab__tables"
    labs = pd.read_sql_query(sql=query, con=conn)["lab_name"]
    conn.close()
    return ["All"] + labs.tolist()


def get_pdf_report(df: pd.DataFrame, date: str, report_name: str) -> str:
    file_name = f"./report-{date}.pdf"
    doc = SimpleDocTemplate(file_name, pagesize=letter)
    elements = []

    # Define styles for the PDF report
    styles = getSampleStyleSheet()
    title_style = styles["Title"]
    title_style.fontSize = 18
    title_style.leading = 24
    title_style.alignment = 1
    title_style.spaceAfter = 12
    stylesN = styles["Normal"]
    stylesN.wordWrap = "CJK"

    # extract data from df
    data = df.values.tolist()
    data = [[Paragraph(str(cell), stylesN) for cell in row] for row in data]

    # Add report name as a title
    title = Paragraph(report_name, title_style)
    elements.append(title)
    elements.append(Spacer(1, 12))

    # Add table with column headings
    table_data = [df.columns.tolist()] + data
    table = Table(table_data)
    column_widths = [100, 100, 200, 100, 100, 100]  # Specify the width for each column
    table.setStyle(
        TableStyle(
            [
                ("BACKGROUND", (0, 0), (-1, 0), colors.grey),
                ("TEXTCOLOR", (0, 0), (-1, 0), colors.whitesmoke),
                ("ALIGN", (0, 0), (-1, -1), "CENTER"),
                ("FONTNAME", (0, 0), (-1, 0), "Helvetica-Bold"),
                ("BOTTOMPADDING", (0, 0), (-1, 0), 12),
                ("BACKGROUND", (0, 1), (-1, -1), colors.beige),
                ("GRID", (0, 0), (-1, -1), 1, colors.black),
                ("COLWIDTH", (0, 0), (-1, -1), column_widths),
            ]
        ),
    )
    elements.append(table)
    doc.build(elements)
    return file_name


def get_records(table: str, column: str, lab: str):
    if lab == "All":
        return f"SELECT * FROM {table}"
    return f"SELECT * FROM {table} WHERE {column} = '{lab}'"


LABS: list[str] = get_lab_names()

cols = st.columns(2)
with cols[0]:
    from_date = st.date_input("From date")
    from_datetime = datetime.datetime.combine(from_date, datetime.time(0, 0, 0, 0))
with cols[1]:
    to_date = st.date_input("To date")
    to_datetime = datetime.datetime.combine(to_date, datetime.time(23, 59, 59, 999999))
lab = st.selectbox("Select lab", LABS)

if st.button("Generate Student Logs"):
    if lab is None:
        st.error("Please select a lab")
        st.stop()

    with st.spinner("Fetching data..."):
        conn: sql.Connection = sql.connect("../database/database.sqlite")

        query1 = get_records("log_details", "labname", lab)
        df: pd.DataFrame = pd.read_sql_query(query1, conn)
        df.drop(["random"], axis=1, inplace=True)
        df["login_time"] = pd.to_datetime(df["login_time"])
        df["logout_time"] = pd.to_datetime(df["logout_time"])
        df = df[
            (df["login_time"] >= from_datetime) & (df["logout_time"] <= to_datetime)
        ]
        df = df.iloc[:, [0, 1, 2, 3, 5, 4]]
        df.set_index("id", inplace=True)
        conn.close()


    date = datetime.datetime.now().strftime("%Y-%m-%d")
    st.write(df)

    # CSV Report
    st.download_button(
        label="Download Student Logs (CSV)",
        data=df.to_csv(),
        file_name=f"student_logs-{date}.csv",
        mime="text/csv",
        key=10,
    )

    # PDF report
    st.download_button(
        label="Download Student Logs (PDF)",
        data=get_pdf_report(df, date, "Student Logs"),
        file_name=f"student_logs-{date}.pdf",
        mime="application/pdf",
        key=11,
    )

if st.button("Generate Device Logs"):
    if lab is None:
        st.error("Please enter a lab name")
        st.stop()
    query = get_records("lablists", "lab_name", lab)

    with st.spinner("Fetching data..."):
        conn: sql.Connection = sql.connect("../database/database.sqlite")
        df1: pd.DataFrame = pd.read_sql_query(query, conn)
        df1["created_at"] = pd.to_datetime(df1["created_at"])
        df1 = df1[
            (df1["created_at"] >= from_datetime) & (df1["created_at"] <= to_datetime)
        ]
        df1.drop(["lab_id", "desc", "updated_at", "created_at"], axis=1, inplace=True)
        df1["S.No."] = df1.index#.reindex(target=)
        df1 = df1[["S.No.", "lab_name", "system_number", "device_name", "spec", "type"]]
        # df1.set_index("id", inplace=True)

        query2 = get_records("printers", "lab_name", lab)
        df2 = pd.read_sql(query2, conn)
        df2 = df2[["printer_model", "serial_number", "lab_name", "status"]]
        conn.close()

    date = datetime.datetime.now().strftime("%Y-%m-%d")

    # CSV Report
    st.download_button(
        label="Download Device Logs (CSV)",
        data=df1.to_csv(),
        file_name=f"device_logs-{date}.csv",
        mime="text/csv",
        key=20,
    )

    report1 = get_pdf_report(df1, date, f"Device Logs - {lab}")
    report2 = get_pdf_report(df2, date, "Printer Logs")
    pdfs = [report1, report2]
    merger = PdfMerger()

    for pdf in pdfs:
        merger.append(pdf)

    merger.write("./result.pdf")
    merger.close()

    # PDF report
    st.download_button(
        label="Download Device Logs (PDF)",
        data=open("./result.pdf", mode='rb').read(),
        file_name=f"device_logs-{date}.pdf",
        mime="application/pdf",
        key=21,
    )

if st.button("Generate Maintenance Logs"):
    if lab is None:
        st.error("Please enter a lab name")
        st.stop()
    query = get_records("maintenance_log", "lab_name", lab)

    with st.spinner("Fetching data..."):
        conn: sql.Connection = sql.connect("../database/database.sqlite")
        df: pd.DataFrame = pd.read_sql_query(query, conn)
        df.drop(["created_at", "updated_at", "lab_id"], axis=1, inplace=True)
        df["moved_time"] = pd.to_datetime(df["moved_time"])
        df["returned_time"] = pd.to_datetime(df["returned_time"])
        df = df[
            (df["moved_time"] >= from_datetime) & (df["returned_time"] <= to_datetime)
        ]
        df.set_index("id", inplace=True)
        conn.close()

    date = datetime.datetime
