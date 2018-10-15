        
//this will update the msg notifiction depending on the state response
function msgHandler(status, msg){
    if(status == true){
        $('#msg').removeClass('alert-danger').addClass('alert-success').html(msg).fadeIn();
    }else{
        $('#msg').removeClass('alert-success').addClass('alert-danger').html(msg).fadeIn();
    }
    setTimeout(function(){ $('#msg').fadeOut(); }, 3000);
}
        
//search function (more like a filter function)
function search(){
    //grab the text typed into search field and turn to uppercase
    let search = $('#search').val().toUpperCase();
    
    //lets grab all the elements in the DOM that are in available course list
    let searchable = $('.searchable');
            
    //loop thru all elements
    for (key = 0; key < searchable.length; key++) {
        course = searchable[key].dataset.name.toUpperCase();
        if (course.indexOf(search) > -1) { //make visible
            searchable[key].style.display = "";
        } else { //hide it from view
            searchable[key].style.display = "none";
        }
    }
}

//this function handles the animation for 2 page sections
function openDetailAnimation(){
    if(window.innerWidth < 992){
        //let make page 1 dissapear
        $('.page1').removeClass('fadeInLeft').addClass('fadeOutLeft').hide();
        //lets make page 2 appear
        $('.page2').removeClass('fadeOutRight').show().addClass('fadeInRight');
    }else{//desktp version
        //lets make page 2 fade in
        $('.page2').removeClass('fadeIn').show().addClass('fadeIn');
    }
}

//this function handles the animation for 2 page sections while going back       
function goBackAnimation(){
    //reversed order
    //this animation will only work from md and below
    if(window.innerWidth < 992){
        //lets make page1 appear
        $('.page1').removeClass('fadeOutLeft').show().addClass('fadeInLeft');
        //lets make page2 dissapear
        $('.page2').removeClass('fadeInRight').addClass('fadeOutRight').hide();
    }
}
