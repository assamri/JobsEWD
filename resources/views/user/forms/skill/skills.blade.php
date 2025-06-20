

<div class="newcvcard">
            

                <div class="cardhead">
                    <h4 onclick="showSkills();">{{__('Skills')}}</h4>
                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#add_skill_modal" onclick="showProfileSkillModal();"><i class="fas fa-plus"></i></a>
                </div>

                <div class="cardintbody">
                <div class="" id="skill_div"></div>
                </div>
             </div>




<div class="modal fade" id="add_skill_modal" tabindex="-1" aria-labelledby="addskilModalLabel" aria-hidden="true" role="dialog"></div>



@push('scripts') 



<script type="text/javascript">



    /**************************************************/



    function showProfileSkillModal(){

    $('#add_skill_modal').css('display','block');

    var myclosemodal = $('<div></div>');

    myclosemodal.addClass('modal-backdrop fade show');

    $('body').append(myclosemodal);





    $("#add_skill_modal").modal();



    loadProfileSkillForm();



    }



    function loadProfileSkillForm(){



    $.ajax({



    type: "POST",



            url: "{{ route('get.front.profile.skill.form', $user->id) }}",



            data: {"_token": "{{ csrf_token() }}"},



            datatype: 'json',



            success: function (json) {



            $("#add_skill_modal").html(json.html);



            }



    });



    }



    function showProfileSkillEditModal(skill_id){

    

    $('#add_skill_modal').css('display','block');

    var myclosemodal = $('<div></div>');

    myclosemodal.addClass('modal-backdrop fade show');

    $('body').append(myclosemodal);



    $("#add_skill_modal").modal();



    loadProfileSkillEditForm(skill_id);



    }



    function loadProfileSkillEditForm(skill_id){



    $.ajax({



    type: "POST",



            url: "{{ route('get.front.profile.skill.edit.form', $user->id) }}",



            data: {"skill_id": skill_id, "_token": "{{ csrf_token() }}"},



            datatype: 'json',



            success: function (json) {



            $("#add_skill_modal").html(json.html);



            }



    });



    }



    function submitProfileSkillForm() {



    var form = $('#add_edit_profile_skill');



    $.ajax({



    url     : form.attr('action'),



            type    : form.attr('method'),



            data    : form.serialize(),



            dataType: 'json',



            success : function (json){



            $ ("#add_skill_modal").html(json.html);



            showSkills();



            },



            error: function(json){



            if (json.status === 422) {



            var resJSON = json.responseJSON;



            $('.help-block').html('');



            $.each(resJSON.errors, function (key, value) {



            $('.' + key + '-error').html('<strong>' + value + '</strong>');



            $('#div_' + key).addClass('has-error');



            });



            } else {



            // Error



            // Incorrect credentials



            // alert('Incorrect credentials. Please try again.')



            }



            }



    });



    }



    function delete_profile_skill(id) {



    var msg = "{{__('Are you sure! you want to delete?')}}";



    if (confirm(msg)) {



    $.post("{{ route('delete.front.profile.skill') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})



            .done(function (response) {



            if (response == 'ok')



            {



            $('#skill_' + id).remove();



            } else



            {



            alert('Request Failed!');



            }



            });



    }



    }



    $(document).ready(function(){



    showSkills();



    });



    function showSkills()



    {



    $.post("{{ route('show.front.profile.skills', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})



            .done(function (response) {



            $('#skill_div').html(response);



            });



    }



</script> 



@endpush