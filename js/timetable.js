var myGroups = [];
var usedBlocks = [];
        
$(document).ready(function(){
    //if we already have a timetable saved, load it
    if(myTimetable.length > 0){
        loadTimetable(myTimetable);
    }
});
        
//this function load the timetable
function loadTimetable(table){
            
    //loop thru your saved timetable groups and add them to timetable
    for (var key in table) {
        moveGroup(table[key].group_id);
    }
}
        
//this function will check for collision while adding subjects to the timetable
function collisionCheck(groupId){
            
    //look for the group sessions in the availableCourses
    sessions = availableCourses[groupId].sessions;
    let collision = false;
    
    //check if sessions exit on the usedBlocks array
    for (var key in sessions){
        
        //blocks are store as row(block) - column(day)
        if(usedBlocks.indexOf(sessions[key].time_block+'-'+sessions[key].day) > -1){
            collision = true;
            break;
        }
    }
            
    return collision;
}
        
//This function will add or remove a group from/to our timetable
function moveGroup(groupId){
            
    //let's look for the buton object
    button = $('[data-group-id="'+groupId+'"]');
    
    //lets grab the sessions from the group
    sessions = availableCourses[groupId].sessions;
    
    //check if the group has been selected (group added to timetable)
    if(button.hasClass('selected')){
            
        //remove sessions from timetable
        for (var key in sessions){
            $('.b-'+sessions[key].time_block+' .day-'+sessions[key].day).empty();
            
            //remove session from usedBlocks array
            usedBlocks = jQuery.grep(usedBlocks, function(value) {
              return value != sessions[key].time_block+'-'+sessions[key].day;
            });
        }
        
        //remove group from myGroups array
        myGroups = jQuery.grep(myGroups, function(value) {
          return value != groupId;
        });
        
        //change icon to + and back to normal button color
        button.removeClass('btn-secondary selected').addClass('btn-primary').children().removeClass('fa-minus').addClass('fa-plus');                
    
    }else{ //we are adding the course group to our timetable
                
        //check session collision FIRST!
        if(collisionCheck(groupId) == false){
            
            //add sessions to timetable
            for (var key in sessions){
                $('.b-'+sessions[key].time_block+' .day-'+sessions[key].day).append(availableCourses[groupId].course_name+' - Room: <b>'+sessions[key].room+'</b');
            
                //add session to the used blocks array (block-day)
                usedBlocks.push(sessions[key].time_block+'-'+sessions[key].day);
            }
            
            //add group to myGroups array
            myGroups.push(parseInt(groupId));
                
            //change the icon to an X and change the color of the button and add selected class
            button.removeClass('btn-primary').addClass('btn-secondary selected').children().removeClass('fa-plus').addClass('fa-minus');
        }else{
            msgHandler(false, 'Can\'t add the course because it clashes with another added course');
        }
    }
}
        
function submitTimetable(){
    $.ajax({
        url: '/ajax/timetable.ajax.php',
        method: 'post',
        dataType: 'json',
        data: {a: 'n', user_id: $('#user_id').val(), courses: myGroups },
    }).done( (response) => {
        msgHandler(response.success, response.msg);
        if(response.redirect != 'none'){
            setTimeout(function(){window.location.href = response.redirect; }, 3000);
        }
    });
}
