
/* EDIT PASSWORD, OLD PASSWORD == NEW PASSWORD */

$("#profile_edit_password").on('submit', function()
{
    var plainPassword = $("#user_edit_password_form_plainPassword").val();
    var verifPass = $("#verif_pass_password").val();

    if (plainPassword != verifPass)
    {
        $(".warning-flash").css('display', 'none');

        $('.pass-verif').css('display', 'block');
        $('.pass-verif-msg').html('New password doesn\'t match.');

        return false;
    }
})

// THEME MODE

$(".dark-mode").click(function()
{
    const body = document.body;

    if(body.classList.contains('dark'))
    {
        body.classList.add('light')
        body.classList.remove('dark')
        localStorage.setItem("mode", "light");
    }
    
    else if(body.classList.contains('light'))
    {
        body.classList.add('dark')
        body.classList.remove('light')
        localStorage.setItem("mode", "dark");
    }
});

if (localStorage.getItem("mode") == "dark")
{
    const body = document.body;

    body.classList.add('dark')
    body.classList.remove('light')
}

else if (localStorage.getItem("mode") == "light")
{
    const body = document.body;

    body.classList.add('light')
    body.classList.remove('dark')
}