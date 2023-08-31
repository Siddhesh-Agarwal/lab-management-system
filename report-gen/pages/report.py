import datetime
import sqlite3 as sql
import pandas as pd
import streamlit as st
from reportlab.lib.pagesizes import letter  # type: ignore
from reportlab.platypus import SimpleDocTemplate, Table  # type: ignore

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
    labs = pd.read_sql_query("SELECT lab_name FROM lab__tables", conn)["lab_name"].unique()  # type: ignore
    conn.close()
    return labs.tolist()


def get_pdf_report(df: pd.DataFrame, date: str) -> bytes:
    doc = SimpleDocTemplate(f"report-{date}.pdf", pagesize=letter)
    elements = []
    table = Table(df.values.tolist())  # type: ignore
    elements.append(table)  # type: ignore
    doc.build(elements)  # type: ignore
    with open(f"report-{date}.pdf", "rb") as f:
        return f.read()


LABS: list[str] = get_lab_names()

cols = st.columns(2)
with cols[0]:
    from_date = st.date_input("From date")
with cols[1]:
    to_date = st.date_input("To date")
lab = st.selectbox("Select lab", LABS)

if st.button("Generate report"):
    if lab == "All":
        query: str = f"SELECT * FROM lab__tables WHERE date BETWEEN '{from_date}' AND '{to_date}'"
    else:
        query: str = f"SELECT * FROM lab__tables WHERE date BETWEEN '{from_date}' AND '{to_date}' AND lab_name = '{lab}'"
    with st.spinner("Fetching data..."):
        conn: sql.Connection = sql.connect("../database/database.sqlite")
        df: pd.DataFrame = pd.read_sql_query("SELECT * FROM log_details", conn)  # type: ignore
        conn.close()

    date = datetime.datetime.now().strftime("%d-%m-%Y %H:%M:%S")

    with st.spinner("Generating report..."):
        pdf = get_pdf_report(df, date)

    # CSV Report
    st.download_button(
        label="Download report (CSV)",
        data=df.to_csv(),
        file_name=f"report-{date}.csv",
        mime="text/csv",
    )

    # PDF report
    st.download_button(
        label="Download report (PDF)",
        data=pdf,
        file_name=f"report-{date}.pdf",
        mime="application/pdf",
    )
