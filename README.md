# Portfolio Website
Simple bootstrap site for my personal portfolio website.

![Screenshot](./screenshot.png)

Check it out live [here](https://jrtechs.me)

## Installation notes

If you wish to run a live instance of this site, 
you need apache installed and php configured to 
send email. 

To install dependency for sending mail on a ubuntu server:
```
sudo apt-get install sendmail
```

On the contact form I use google's
 [reCAPTCHA](https://developers.google.com/recaptcha/) api. If you wish
 to use reCAPTCHA on your website, you need to sign up for an account on google's website.
The secret for the captcha goes in a text file above the root 
directory for this website called "captchaSecret.txt". The destination
email address is stored above the root directory in a file called "email.txt".