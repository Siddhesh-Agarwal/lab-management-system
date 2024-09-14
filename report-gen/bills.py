import streamlit as st
import sqlite3

st.set_page_config(
    page_title="Bill Management",
    page_icon="📄",
    layout="centered",
    initial_sidebar_state="auto",
    menu_items=None,
)

st.title("Bill Management")

tab = st.tabs(["Upload Bills", "View Bills"])


def get_labs():
    return ["temp"]


with tab[0]:
    with st.form("upload_bills"):
        st.header("Upload Bills")
        date = st.date_input("Date")
        lab = st.selectbox("Lab", ["temp"])
        file = st.file_uploader("File")
        submit = st.form_submit_button("Upload")
        if submit:
            if not date or not lab or not file:
                st.error("Please fill all the fields")
            else:
                with st.spinner("Uploading..."):
                    engine = sqlite3.connect("bills.db")
                    cursor = engine.cursor()
                    cursor.execute(
                        "CREATE TABLE IF NOT EXISTS bills (id INTEGER PRIMARY KEY AUTOINCREMENT, date DATE, lab TEXT, file BLOB, name TEXT)"
                    )
                    cursor.execute(
                        "INSERT INTO bills (date, lab, file, name) VALUES (?, ?, ?, ?)",
                        (date, lab, file.read(), file.name),
                    )
                    engine.commit()
                st.success("Uploaded!")

with tab[1]:
    with st.form("view_bills"):
        st.header("View Bills")
        from_date = st.date_input("From Date")
        to_date = st.date_input("To Date")
        lab = st.selectbox("Lab", ["temp"])
        submit = st.form_submit_button("View")
        if submit:
            with st.spinner("Fetching..."):
                engine = sqlite3.connect("bills.db")
                cursor = engine.cursor()
                cursor.execute(
                    "SELECT * FROM bills WHERE date >= ? AND date <= ? AND lab = ?",
                    (from_date, to_date, lab),
                )
                bills = cursor.fetchall()
                st.session_state.bills = bills
    if "bills" in st.session_state:
        for bill in st.session_state.bills:
            # display the bill
            with st.expander(bill[4]):
                st.write(f"**Added on:** `{bill[1]}`")
                st.download_button(
                    label="Download",
                    data=bill[2],
                    file_name=bill[4],
                    mime="application/pdf",
                )
