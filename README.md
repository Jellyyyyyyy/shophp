# project1005

## IMPORTANT! Backup files

You can find all the back up files in the [google drive](https://drive.google.com/drive/folders/1ukoGO-lrBeTLBylbu4-1jGtRL7ZTEHCb?usp=share_link). Files will frequently be backed up there so we do not lose any progress if anything happens

---

## <ins>Directories</ins>

### css

Ensure that all CSS files go into this directory. Remember to add links to your php files so styling gets applied. CSS for nav and footer is automatically added by adding `include_once "include/head.inc.php"`

---

### js

Ensure that all JavaScript files go into js directory. JavaScript for nav and footer is automatically added by adding `include_once "include/head.inc.php"`

---

### images

To be further worked on. Currently put all the images here for easy access. Will add more folders inside. <br>
Also contains `icons` directory to hold favicon for the page

---

### include

- dbcon.inc.php<br>
  Contains php code to connect to database. To use, add `include_once "include/dbcon.inc.php"` at where connection is supposed to take place. Remember to close connection with `$conn->close()`
- functions.inc.php<br>
  Contains all the functions that are needed across multiple files like `sendMail()`. Add more functions as more pages are created. To use, add `require_once "include/functions.inc.php"` at the start of php portion
- head.inc.php<br>
  Update this as the project goes, if CSS/JS files are required in all pages, add them here for easy access. In all pages, the head should contain `include_once "include/head.inc.php"`
- nav/footer.inc.php<br>
  Code for navbar and footer. Add `include_once "include/nav.inc.php"` at the top of `<body>` in all pages that require nav bar. Same for footer
