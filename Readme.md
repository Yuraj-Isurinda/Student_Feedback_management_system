# 🎓 University Feedback Management System

A full-stack web application for collecting and managing student feedback on academic subjects and lecturers. This system allows students to submit structured feedback, while lecturers and administrators can view and analyze responses efficiently.

## 🚀 Features

### 🧑‍🎓 Student Module
- **User Registration:** Students can register using their credentials.
- **Approval System:** Student accounts remain in a `pending` state until approved by an admin.
- **Feedback Submission:** 
  - Structured form with rating scales and comment fields.
  - Lists subjects and lecturers dynamically.
  - Validations ensure accurate and complete submissions.

### 👩‍🏫 Lecturer Module
- **Secure Login:** Lecturers log in using assigned credentials.
- **Dashboard View:**
  - View feedback statistics per subject.
  - See aggregated ratings and student comments.
  - Track performance trends over time.
- **Anonymity:** Student identity is hidden to ensure honest feedback.

### 🛠️ Admin Module
- **User Management:**
  - Approve/reject student registrations.
  - Add/edit lecturer and student accounts.
  - Assign subjects to lecturers.
- **Feedback Oversight:**
  - Global feedback view across departments.
  - Export reports in PDF or Excel.
  - Monitor activity logs for transparency and auditing.

---

## 🧩 Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL

---

## 🗃️ Database Structure (Simplified)

```sql
students(id, name, email, department_id, status, password_hash)
lecturers(id, name, email, department_id)
subjects(id, subject_name, lecturer_id)
feedback(id, student_id, subject_id, rating_1, rating_2, ..., comments, timestamp)
admin(id, username, password_hash)
registrations(student_id, status, submitted_at, approved_at)
logs(id, user_id, action, timestamp)
