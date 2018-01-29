function validate(form) {
  fail = validateUsername(form.username.value)
  fail += validatePassword(form.password.value)

  if (fail == "") return true
  else {
    alert(fail); return false
     }
 };

 function validateUsername(field) {
 if (field == "") return "No Username was entered.\n"
    return ""
 };

 function validatePassword(field) {
if (field == "") return "No Password was entered.\n"
 else return ""
}
