/*
  This function is used for incremeting and decreasing of product quantity that the user want to purchase.
*/
function qty(button, what)
{
    if(what == "inc")  button.previousElementSibling.value++;
    else if( what == "desc"){
       if( button.nextElementSibling.value >= 2 )
       {
         button.nextElementSibling.value--;
       }
    }
}

