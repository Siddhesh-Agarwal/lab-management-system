from typing import Any
import streamlit as st
from datetime import datetime, date
import sqlite3 as sql

st.set_page_config(
    page_title="Bill Management",
    page_icon="📄",
    layout="centered",
    initial_sidebar_state="auto",
    menu_items=None,
)

st.title("Bill Management")


# Constants
CURRENT_YEAR: int = datetime.now().year
MONTHS: list[str] = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
]

@st.cache_data
def get_lab_names() -> list[str]:
    conn = sql.connect("../database/database.sqlite")
    labs: list[str] = [i[0] for i in conn.execute("SELECT lab_name FROM lab__tables").fetchall()]
    labs = ["All"] + labs
    conn.close()
    return labs

LABS = get_lab_names()
CURRENT_MONTH_INDEX: int = datetime.now().month - 1
OPTIONS: list[str] = ["Upload bill", "View bills"]


# Main
tabs = st.tabs(OPTIONS)

with tabs[0]:
    st.subheader("Upload bill")
    file = st.file_uploader("Upload file", type=["pdf"])
    cols = st.columns(2)

    with cols[0]:
        month: str = str(
            st.selectbox(
                label="Select month",
                options=MONTHS,
                index=datetime.now().month - 1,
            )
        )
    with cols[1]:
        year: int = int(
            st.number_input(
                label="Enter year",
                min_value=2000,
                max_value=CURRENT_YEAR,
                value=CURRENT_YEAR,
                step=1,
            )
        )
    lab = st.selectbox(
        label="Select lab",
        options=LABS,
        index=0,
        key=1,
    )

    if st.button("Upload"):
        if file is None:
            st.error("Please upload a file", icon="⚠️")
        else:
            conn = sql.connect("./bills.sqlite")
            cur = conn.cursor()
            cur.execute(
                "CREATE TABLE IF NOT EXISTS bills (month INTEGER, year INTEGER, lab TEXT, file BLOB, name TEXT)"
            )
            month_number: int = MONTHS.index(month) + 1
            cur.execute(
                "INSERT INTO bills VALUES (?, ?, ?, ?, ?)",
                (month_number, year, lab, file.read(), file.name),
            )
            conn.commit()
            conn.close()
            st.toast("File uploaded successfully", icon="🎉")
            st.balloons()

with tabs[1]:
    st.subheader("View bills")

    cols = st.columns(2)
    lab: str | None = st.selectbox(
        label="Select lab",
        options=LABS,
        index=0,
        key=2
    )
    with cols[0]:
        from_date = st.date_input(
            label="From date",
            value=datetime.now().date(),
            max_value=datetime.now().date(),
        )
    with cols[1]:
        to_date = st.date_input(
            label="To date",
            value=datetime.now().date(),
            max_value=datetime.now().date(),
        )
    if st.button("View"):
        # based on dates
        if isinstance(from_date, date) and isinstance(to_date, date):
            # Convert dates to year and month
            from_year: int = from_date.year
            from_month: int = from_date.month
            to_year: int = to_date.year
            to_month: int = to_date.month

            conn: sql.Connection = sql.connect("./bills.sqlite")
            cur: sql.Cursor = conn.cursor()
            # check is 'bills' table exists
            cur.execute(
                "SELECT name FROM sqlite_master WHERE type='table' AND name='bills'"
            )
            exists: bool = bool(cur.fetchone())
            if not exists:
                st.error("No bills found", icon="⚠️")
                st.stop()
            cur.execute(
                "SELECT * FROM bills WHERE year >= ? AND year <= ? and lab = ?",
                (from_year, to_year, lab),
            )
            rows: list[Any] = cur.fetchall()
            if len(rows) == 0:
                st.error(f"No bills found between {from_date} and {to_date}", icon="⚠️")
            else:
                for i, row in enumerate(rows, start=1):
                    if any(
                        [
                            (row[1] > from_year and row[1] < to_year),
                            (row[1] == from_year and row[0] >= from_month),
                            (row[1] == to_year and row[0] <= to_month),
                        ]
                    ):
                        # st.markdown(f"### Bill {i}")
                        st.markdown(f"### {i}) {row[3]}")
                        st.markdown(f"**Uploaded on**: {MONTHS[row[0] - 1]} {row[1]}")
                        st.markdown("**Size**: {:.2f} KB".format(len(row[2]) / 1024))
                        st.download_button(
                            label="Download",
                            data=row[2],
                            file_name=row[3],
                            mime="application/pdf",
                            key=i,
                        )
                        st.divider()
        else:
            st.error("Please enter valid dates", icon="⚠️")
