# MediPlan

You have an appointment at the Doctor and the Doctor asks you if you need a prescription for your medicals or are enough until the next appointment.
Some people (me inlcuded) don't check how much medicine they got, before they got an appointment at the doctor. So i decided to develop a little web application for automated checking if a medical is needed.

Just add your medicals to the medication plan and add your stock of the medicals.

If you are at the Doctor, you simply type in the date of the next appointment and the application checks if you need a prescription for any of your medicals.


## Deployment

To remove the used medicals, a cronjob is needed. The cronjob is executed every day at 0:00am.

```bash
  * * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```
