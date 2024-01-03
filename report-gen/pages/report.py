import datetime
import os
import sqlite3 as sql
import time

import pandas as pd
import streamlit as st
from reportlab.lib import colors
from reportlab.lib.pagesizes import letter
from reportlab.lib.styles import getSampleStyleSheet    
from reportlab.platypus import Paragraph, SimpleDocTemplate, Spacer, Table, TableStyle

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
    conn = sql.connect("../database/database.sqlite")
    labs = pd.read_sql_query("SELECT lab_name FROM lab__tables", conn)["lab_name"].unique()
    conn.close()
    return ["All"] + labs.tolist()

def get_pdf_report(df: pd.DataFrame, date: str, report_name: str) -> bytes:
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

    # Add report name as a title
    title = Paragraph(report_name, title_style)
    elements.append(title)
    elements.append(Spacer(1, 12))

    # Add table with column headings
    table_data = [df.columns.tolist()] + df.values.tolist()
    table = Table(table_data)
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
            ]
        )
    )
    column_widths = [100, 100, 200, 100, 100, 100]  # Specify the width for each column
    table.setStyle(TableStyle([
    ('COLWIDTH', (0, 0), (-1, -1), column_widths),
    ('WORDWRAP', (1, 1), (1, -1)),  # Enable word wrapping for the second column (index 1)
]))

    elements.append(table)


    doc.build(elements)
    # read and store bytes stream in variable `pdf_data`
    with open(file_name, mode="rb+") as pdf_file:
        pdf_data = pdf_file.read()
    os.remove(file_name)  # clears stuff for next run
    return pdf_data

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
    if lab == "All":
        query: str = f"SELECT * FROM log_details"
    else:
        query: str = f"SELECT * FROM log_details WHERE labname = '{lab}'"

    with st.spinner("Fetching data..."):
        conn: sql.Connection = sql.connect("../database/database.sqlite")
        df: pd.DataFrame = pd.read_sql_query(query, conn)
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
    if lab == "All":
        query: str = f"SELECT * FROM lablists"
    else:
        query: str = f"SELECT * FROM lablists WHERE lab_name = '{lab}'"

    with st.spinner("Fetching data..."):
        conn: sql.Connection = sql.connect("../database/database.sqlite")
        df: pd.DataFrame = pd.read_sql_query(query, conn)
        df.drop(["lab_id", "desc", "updated_at"], axis=1, inplace=True)
        df["created_at"] = pd.to_datetime(df["created_at"])
        df = df[(df["created_at"] >= from_datetime) & (df["created_at"] <= to_datetime)]
        df.set_index("id", inplace=True)
        conn.close()

    date = datetime.datetime.now().strftime("%Y-%m-%d")
    st.write(df)

    # CSV Report
    st.download_button(
        label="Download Device Logs (CSV)",
        data=df.to_csv(),
        file_name=f"device_logs-{date}.csv",
        mime="text/csv",
        key=20,
    )

    # PDF report
    st.download_button(
        label="Download Device Logs (PDF)",
        data=get_pdf_report(df, date, "Device Logs"),
        file_name=f"device_logs-{date}.pdf",
        mime="application/pdf",
        key=21,
    )

if st.button("Generate Maintenance Logs"):
    if lab == "All":
        query: str = f"SELECT * FROM maintenance_log"
    else:
        query: str = f"SELECT * FROM maintenance_log WHERE lab_name = '{lab}'"

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
