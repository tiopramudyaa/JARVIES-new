---
key: profile
chapter: account
order: 120
title: Your profile and password
summary: Read your company data and send yourself a password reset link.
requires: ["@customer"]
updated: 2026-10-29
---
`Profile` shows the data Eclectic holds about your company, and is where you request a new password.

## Who uses this

Customers.

## Before you start

- The company data is read only. To correct it, contact Eclectic.
- A reset link goes to the email registered for your account. If none is registered, the portal tells you to contact support.

## Step by step

![The Profile page with company details and the Basic Data tab](images/guide/jarvies-profile.png)

*Screenshot with sample data.*

1. Open `Profile` from the menu under your name at the top right, or from `My Profile` on the `Dashboard`.
2. Use the tabs to read your data: `Basic Data`, `Address`, `Contact Person`, `Identification`, `Bank Account` and `Attachment`. In `Attachment`, you can download the files kept for your company.
3. To change your password, open the `Change Password` tab. It shows your `Registered Email`.
4. Select `Send Password Reset Link`.
5. Open the email, select the button, and set a new password. The link is valid for 24 hours. See [[sign-in]].

## What happens next

Your current password keeps working until you set a new one with the link. After you set it, you are signed in with the new password.

## Common questions

**I cannot edit my data.** It is read only here. Contact the RPMO team to change it.

**It says `No email address is associated with your account.`** Your account has no email. Contact support.

**A tab is empty.** Eclectic has no data of that kind for your company yet.

<!-- sources: resources/views/profile/customer/show.blade.php, app/Http/Controllers/ProfileController.php, routes/web.php -->
