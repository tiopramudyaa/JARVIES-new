---
key: sign-in
chapter: getting-started
order: 20
title: Sign in and password
summary: Sign in for the first time, set your password, and reset it when you forget it.
requires: []
updated: 2026-10-29
---
You sign in with your email address and a password. The first time, you set the password yourself through a link sent to your email.

## Who uses this

Every customer contact and every Super Admin.

## Before you start

- Use the email address that is registered for you at Eclectic. If it is not registered, the portal says `Invalid email or password.`
- Open your mailbox on hand: the first sign-in needs an email from JARVIES.
- A password must have at least 8 characters.

## Step by step

![The JARVIES sign in page with the email and password fields](images/guide/jarvies-login.png)

*Screenshot with sample data.*

### First time

1. Open the portal and enter your email and any password of at least 6 characters. It does not need to be correct yet.
2. The portal tells you `Password Setup Required` and opens `Check Your Email`.
3. Open the email and select `Set My Password`. The link is valid for 24 hours.
4. In `Set New Password`, type the password in `New Password` and again in `Confirm Password`. The page checks that it has at least 8 characters and that both match.
5. Submit. You are signed in and taken to the `Dashboard`.

### Every other time

1. Enter your email and your password.
2. Sign in. You land on the `Dashboard`.
3. To leave, open the menu under your name at the top right and sign out.

### If you forget your password

1. The sign-in page has no `Forgot password` link. Add `/password/forgot` to the end of the portal address, or use `Resend password reset link` on the `Check Your Email` page.
2. In `Forgot Password?`, enter your registered email and select `Send Password Reset Link`.
3. Open the email, select `Reset My Password`, and set a new password as above. The link is valid for 24 hours.

If you are already signed in, you can also send yourself a reset link from your profile. See [[settings]].

## What happens next

After you set a password, you can sign in normally. A link that is older than 24 hours no longer works, and the portal asks you to request a new one.

## Common questions

**I did not receive the email.** Check your Spam or Junk folder, and check that the address is correct. If it still does not arrive, contact the helpdesk team.

**The link says it has expired.** Request a new one. Each link is valid for 24 hours.

**It says `Your account is inactive.`** Your account or your company account was switched off. Contact the RPMO team.

**It says `Invalid email or password.`** The email may be wrong, or not registered. The portal gives the same message on purpose.

<!-- sources: app/Http/Controllers/AuthController.php, app/Http/Controllers/PasswordSetupController.php, resources/views/auth/login.blade.php, resources/views/auth/check-email.blade.php, resources/views/auth/change-password.blade.php, resources/views/auth/forgot-password.blade.php -->
