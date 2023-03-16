# Lab Management

## Requirements

### 15th March 2023

1. Student login/logout using ID Scan
    - Store time spent, roll number, department, year.
2. Lab Technician Login for each Lab
3. lab-wise stock management (Laptops, PC, network switches, printers, etc.)
    - serial number (optional)
    - system model number
    - system make
    - system count
4. Super admin to monitor all labs
    - Advanced search by Serial number, mode number and labs
    - Scrap management for consumables - PC, Laptops, network switches, printers, etc.
5. Lab Technicians are admins and can login to the system.
    - Lab Technicians can add new devices to the system (own labs).
    - Modify the existing devices (own labs).
    - Scrap machines (own labs).
    - generate reports (own labs).
    - logout all students (own labs).
7. Super admin (1 total)
    - Can add new devices to the system (for all labs).
    - Modify the existing devices (for all labs)
    - Scrap machines (for all labs).
    - Generate reports (for all labs).
    - View number of logged in students (lab-wise).
    - changes roles of lab technicians (admins) to super admin.
    - logout all students (from all labs)
8. Report generation 
    - Admin and Super admin can generate reports.
    - List of devices in the particular lab and departments.
    - Report in Excel and PDF format.
9. Bill management (separate portal)
    - Store bills in drive

____

## System Requirements

- 8 GB RAM computer with ubuntu (server edition)

____

## Tech stack

- Laravel (PHP)
- SQLite
- React + Bootstrap
- Desktop-view first

____

## Schema

**Database**: SQLite3

### Roles

Assignment of roles for users

- Username
- password
- role (technician / admin)
- lab (Lab name / room number / ALL)

### Attendance

Stores the in and out time for auditing purposes

- Roll number (using barcode)
  - year
  - department
- Time in
- Time out
- Lab name

### Devices

Store the information of devices.

- Device name
- Serial Number (optional)
- System model number
- System make
- System count
- Lab name / Room number

### Scrap

Store the information of scrapped devices.

- Device name
- Serial Number (optional)
- System model number
- Count
- Lab name
