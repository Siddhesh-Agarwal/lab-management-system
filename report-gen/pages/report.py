import os
import datetime
import sqlite3 as sql
import pandas as pd
import streamlit as st
from reportlab.lib.pagesizes import letter  # type: ignore
from reportlab.platypus import SimpleDocTemplate, Table  # type: ignore
import time

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
    return ["All"] + labs.tolist()


def get_pdf_report(df: pd.DataFrame, date: str) -> bytes:
    file_name = f"./report-{date}.pdf"
    doc = SimpleDocTemplate(file_name, pagesize=letter)
    elements = []
    table = Table(df.values.tolist())  # type: ignore
    elements.append(table)  # type: ignore
    doc.build(elements)
    crap = bytes(open(file_name, mode="rb+").read())
    os.remove(file_name)
    return crap

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
        df: pd.DataFrame = pd.read_sql_query(query, conn)  # type: ignore
        df.drop(["random"], axis=1, inplace=True)
        df['login_time'] = pd.to_datetime(df['login_time'])
        df['logout_time'] = pd.to_datetime(df['logout_time'])
        df = df[(df['login_time'] >= from_datetime) & (df['logout_time'] <= to_datetime)]
        conn.close()

    date = datetime.datetime.now().strftime("%Y-%m-%d")
    st.write(df)

    # CSV Report
    st.download_button(
        label="Download Student Logs (CSV)",
        data=df.to_csv(),
        file_name=f"student_logs-{date}.csv",
        mime="text/csv",
        key=10
    )

    # PDF report
    st.download_button(
        label="Download Student Logs (PDF)",
        data=get_pdf_report(df, date),
        file_name=f"student_logs-{date}.pdf",
        mime="application/pdf",
        key=11
    )

if st.button("Generate Device Logs"):
    if lab == "All":
        query: str = f"SELECT * FROM lablists"
    else:
        query: str = f"SELECT * FROM lablists WHERE labname = '{lab}'"
    
    with st.spinner("Fetching data..."):
        conn: sql.Connection = sql.connect("../database/database.sqlite")
        df: pd.DataFrame = pd.read_sql_query(query, conn)
        df.drop(["lab_id", "desc", "updated_at"], axis=1, inplace=True)
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
        key=20
    )

    # PDF report
    st.download_button(
        label="Download Device Logs (PDF)",
        data=get_pdf_report(df, date),
        file_name=f"device_logs-{date}.pdf",
        mime="application/pdf",
        key=21
    )

if st.button("Generate Maintenance Logs"):
    if lab == "All":
        query: str = f"SELECT * FROM maintenance_log"
    else:
        query: str = f"SELECT * FROM maintenance_log WHERE labname = '{lab}'"
    
    with st.spinner("Fetching data..."):
        conn: sql.Connection = sql.connect("../database/database.sqlite")
        df: pd.DataFrame = pd.read_sql_query(query, conn)
        df.drop(["created_at", "updated_at", "lab_id"], axis=1, inplace=True)
        df.set_index('id', inplace=True)
        conn.close()

    date = datetime.datetime.now().strftime("%Y-%m-%d")
    st.write(df)

    # CSV Report
    st.download_button(
        label="Download Maintenance Logs (CSV)",
        data=df.to_csv(),
        file_name=f"maintenance_logs-{date}.csv",
        mime="text/csv",
        key=30
    )

    # PDF report
    st.download_button(
        label="Download Maintenance Logs (PDF)",
        data=get_pdf_report(df, date),
        file_name=f"maintenance_logs-{date}.pdf",
        mime="application/pdf",
        key=31
    )