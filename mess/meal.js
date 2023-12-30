function my_cal(){


    var my_meal_tk = document.getElementById('my_meals_tk').value;
    var my_others_tk = document.getElementById('my_others_tk').value;

    var all_m_given_tk = document.getElementById('all_my_g_tk').value;



    // var m_m_tk = parseFloat(my_meal_tk).toFixed(2);
    // var m_o_tk = parseFloat(my_others_tk).toFixed(2);
    // var a_g_tk = parseFloat(all_m_given_tk).toFixed(2);
    var m_m_tk = parseFloat(my_meal_tk);
    var m_o_tk = parseFloat(my_others_tk);
    var a_g_tk = parseFloat(all_m_given_tk);

    // var m_m_tk = parseInt(my_meal_tk);
    var mot_khoroc = m_m_tk+m_o_tk;

        var mot_tk = document.getElementById('all_my_g_tk').value = mot_khoroc;

        document.getElementById('all_my_g_html').innerHTML = mot_khoroc;



    var my_baz_tk = document.getElementById('my_bazar_tk').value;
    var my_paid_tk = document.getElementById('my_paid_tk').value;
    var tk_g_g = document.getElementById('tk_g_g').value;

    var bazar_and_paid = parseFloat(my_baz_tk) + parseInt(my_paid_tk);


    var all_tk = document.getElementById('tk_g_g').value = mot_tk - bazar_and_paid;
    var give_or_get = parseFloat(all_tk).toFixed(2);


    document.getElementById('tk_g_g_html').innerHTML = give_or_get;

    if(give_or_get<0){
        document.getElementById('get_give_show').innerHTML = 'পাবেনঃ';
        var all_tkk = document.getElementById('tk_g_g').value = bazar_and_paid - mot_tk;
        var give_or_gett = parseFloat(all_tkk).toFixed(2);

        document.getElementById('tk_g_g_html').innerHTML = give_or_gett;

    }else{
        document.getElementById('get_give_show').innerHTML = 'দিবেনঃ';
        var all_tkk = document.getElementById('tk_g_g').value = mot_tk - bazar_and_paid;
        var give_or_gett = parseFloat(all_tkk).toFixed(2);

        document.getElementById('tk_g_g_html').innerHTML = give_or_gett;

    }



}

// function my_calc(){

// }