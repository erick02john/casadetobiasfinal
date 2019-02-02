<script type="text/javascript">
var digitsOnly = /[1234567890]/g;
var integerOnly = /[0-9\.]/g;
var isbnOnly = /[0-9\.\-]/g;
var phoneOnly = /[0-9\-]/g;
var alphaOnly = /[A-Za-z]/g;
var dateOnly = /[0-9\/]/g;
var alphanumeric = /[A-Za-z0-9]/g;
function restrictCharacters(myfield, e, restrictionType) {
    if (!e) var e = window.event
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    var character = String.fromCharCode(code);

    if (code==27) { this.blur(); return false; }
    
    if (!e.ctrlKey && code!=9 && code!=8 && code!=36 && code!=37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40) {
        if (character.match(restrictionType)) {
            return true;
        } else {
            return false;
        }
        
    }
}

function isAlphaKey(evt) 
{
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :((evt.which) ? evt.which : 0));

    if(charCode > 32 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)){return false;}
    return true;
}


function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode;

    if(charCode > 31 && (charCode < 48 || charCode > 57)){return false;}
    return true;
}


function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(emailField.value) == false) 
        {
            swal({
                  title: "Invalid Email Address!",
                  text: "Please enter a valid email. example@email.com",
                  type: "error",
                  showConfirmButton: true
                }, function(){
                       //window.location.href = "//stackoverflow.com";
                });
            return false;
        }

        return true;

}
</script>