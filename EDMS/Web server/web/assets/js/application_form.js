


function changePosition(){
    document.getElementById('first-part_application-form').className += " hidden";
    document.getElementById('second-part_application-form').className = '';

    location.href= '#second-part_application-form';
}


function goBack(){
    document.getElementById('first-part_application-form').className = "";
    document.getElementById('second-part_application-form').className+= ' hidden';

    location.href= '#first-part_application-form';
}


//------- edit form

function upload_message(type,message){

    var msg_bar = document.getElementById('msg-upload');


    if(type === 'loading'){
        msg_bar.className = 'messages alert alert-warning';
    }
    else if(type==='success')
        msg_bar.className = 'messages alert alert-success';
    else{
        msg_bar.className = 'messages alert alert-danger'
    }

    msg_bar.innerText = message;

}



function readURL(input){

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img-preview').attr('src', e.target.result);

            // var fcs = null;
            //
            // // upload_message('loading','The image is being processed');
            //
            // for(var i=0;i<5;i++) {
            //
            //     try {
            //         var fc = check_the_image();
            //
            //         if(fc.length === 1){
            //             fcs = fc
            //         }
            //     }
            //     catch (e) {
            //     }
            //
            // }
            //
            // if(fcs == null){
            //     upload_message('failure','The image was not correct! Check it to be only your face!');
            //     document.getElementById('app_bundleapplication_form_image').value = "";
            // }
            //
            //
            // if(fcs.length === 1){
            //     upload_message('success','The image is correct! Thank you!!!');
            // }else{
            //     upload_message('failure','The image was not correct! Check it to be only your face!');
            //     document.getElementById('app_bundleapplication_form_image').value = "";
            // }

        };


        reader.readAsDataURL(input.files[0]);

    }

}



function onNextPressedButton(){


    //todo check if the content is filled ok

    document.getElementById('first-part_application-form').className += " hidden";
    document.getElementById('second-part_application-form').className = '';

    location.href= '#second-part_application-form';

    document.getElementById('first_part').className  = 'list-group-item';
    document.getElementById('second_part').className  += ' active';

}


function triggerCustomMsg(element,message)
{
    element.setCustomValidity(message);
    element.style = 'border: 1px solid #ff0033';

}


function isEmpty(){

    var flag = true;


    var name = document.getElementById('app_bundleapplication_form_name');


    if(name.value === ''){
        triggerCustomMsg(name,'Please Make Sure you fill those, before next step.');
        flag = false;
    }

    var surname = document.getElementById('app_bundleapplication_form_surname');
    if(surname.value === ''){
        triggerCustomMsg(surname,'Please Make Sure you fill those, before next step.');
        flag = false;
    }

    var nationality = document.getElementById('app_bundleapplication_form_nationality');
    if(nationality.value === ''){
        triggerCustomMsg(nationality,'Please Make Sure you fill those, before next step.');
        flag = false;
    }

    var city = document.getElementById('app_bundleapplication_form_city');
    if(city.value === ''){
        triggerCustomMsg(city,'Please Make Sure you fill those, before next step.');
        flag = false;
    }

    var phone_nr = document.getElementById('app_bundleapplication_form_phoneNumber');
    if(phone_nr.value === ''){
        triggerCustomMsg(phone_nr,'Please Make Sure you fill those, before next step.');
        flag = false;
    }

    var address = document.getElementById('app_bundleapplication_form_address');
    if(address.value === ''){
        triggerCustomMsg(address,'Please Make Sure you fill those, before next step.');
        flag = false;
    }


    var email = document.getElementById('app_bundleapplication_form_email');
    if(email.value === ''){
        triggerCustomMsg(email,'Please Make Sure you fill those, before next step.');
        flag = false;
    }


    var department = document.getElementById('app_bundleapplication_form_department');
    if(department.value === ''){
        triggerCustomMsg(department,'Please Make Sure you fill those, before next step.');
        flag = false;
    }

    if(flag)
        onNextPressedButton();

    return flag;

}


function check_the_image(){

    var faces_s = 0;

    $('#img-preview').faceDetection({
        complete: function (faces) {
            faces_s = faces;
            // console.log(faces);
        },
        error:function (code, message) {
            alert('Error: ' + message);
        }
    });

    return faces_s;

}

