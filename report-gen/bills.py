import sqlite3 as sql
import datetime as dt
from typing import Optional

import streamlit as st
from sqlmodel import Field, SQLModel, Session, create_engine, select, PrimaryKeyConstraint

st.set_page_config(
    page_title="Bill Management",
    page_icon="📄",
    layout="centered",
    initial_sidebar_state="auto",
    menu_items=None,
)

st.title("Bill Management")


@st.cache_data
def get_lab_names() -> list[str]:
    conn = sql.connect("../database/database.sqlite")
    labs: list[str] = [
        i[0] for i in conn.execute("SELECT lab_name FROM lab__tables").fetchall()
    ]
    labs = ["All"] + labs
    conn.close()
    return labs


# Constants
LABS = get_lab_names()


class Bills(SQLModel, table=True, extend_existing=True):
    id: Optional[int] = Field(default=None, primary_key=True)
    date: str
    lab: str
    file: bytes
    name: str


# Main
tabs = st.tabs(["Upload bill", "View bills"])

with tabs[0]:
    st.subheader("Upload bill")
    file = st.file_uploader("Upload file", type=["pdf"])
    date = st.date_input("choose a date")
    lab = st.selectbox(
        label="Select lab",
        options=LABS,
        index=0,
        key=1,
    )

    if st.button("Upload"):
        if file is None:
            st.error("Please upload a file", icon="⚠️")
        elif lab is None:
            st.error("Please choose a lab", icon="⚠️")
        else:
            engine = create_engine("sqlite:///bills.db", echo=True)
            SQLModel.metadata.create_all(engine)
            date_str = str(date.strftime("YYYY-MM-DD"))
            bill = Bills(date=date_str, lab=lab, file=file.read(), name=file.name)
            with Session(engine) as session:
                session.add(bill)
                session.commit()
            st.toast("File uploaded successfully", icon="🎉")
            st.balloons()

with tabs[1]:
    st.subheader("View bills")

    cols = st.columns(2)
    lab: str | None = st.selectbox(label="Select lab", options=LABS, index=0, key=2)
    with cols[0]:
        from_date = st.date_input(
            label="From date",
            value=dt.datetime.now().date(),
            max_value=dt.datetime.now().date(),
        )
    with cols[1]:
        to_date = st.date_input(
            label="To date",
            value=dt.datetime.now().date(),
            max_value=dt.datetime.now().date(),
        )
    if st.button("View"):
        # based on dates
        if from_date and to_date:
            date1 = str(from_date.strftime("YYYY-MM-DD"))
            date2 = str(to_date.strftime("YYYY-MM-DD"))
            engine = create_engine("sqlite:///bills.db", echo=True)
            with Session(engine) as session:
                query = select(Bills).where(date1 <= Bills.date, date2 <= Bills.date)
                data = list(session.exec(query))
            if len(data) == 0:
                st.warning("Couldn't find any Bills in those dates.")
            else:
                for i, row in enumerate(data):
                    st.markdown(f"### {i+1}) {row.name}")
                    st.markdown(f"Uploaded on: `{row.date}`")
                    st.download_button(
                        label=f"Download {row.name}",
                        data=row.file,
                        file_name=row.name,
                        mime="application/pdf",
                    )
        else:
            st.error("Invalid dates")
