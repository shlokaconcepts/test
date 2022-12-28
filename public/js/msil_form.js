"use strict";
$(document).ready(function () {
    $("#marital_status")
        .change(function () {
            if ($(this).val() == "Married") {
                $(".depend_on_marital_status").removeClass("d-none");
            } else {
                $(".depend_on_marital_status").addClass("d-none");
            }
        })
        .change();
    $("#relative_government_employed")
        .change(function () {
            if ($(this).val() == "YES") {
                $(".depend_on_rel_gov_emp").removeClass("d-none");
            } else {
                $(".depend_on_rel_gov_emp").addClass("d-none");
            }
        })
        .change();
    $("#apprentice")
        .change(function () {
            if ($(this).val() == "YES") {
                $("#apprentice_Wrapper").removeClass("d-none");
            } else {
                $("#apprentice_Wrapper").addClass("d-none");
            }
        })
        .change();
    $("#previous_company_work")
        .change(function () {
            if ($(this).val() == "YES") {
                $("#Work_Experience_Wrapper").removeClass("d-none");
            } else {
                $("#Work_Experience_Wrapper").addClass("d-none");
            }
        })
        .change();
    $("#car_driving")
        .change(function () {
            if ($(this).val() == "YES") {
                $(".car_driving_detail").removeClass("d-none");
            } else {
                $(".car_driving_detail").addClass("d-none");
            }
        })
        .change();
    $("#physically_handicapped")
        .change(function () {
            if ($(this).val() == "YES") {
                $(".physically_handicapped_detail").removeClass("d-none");
            } else {
                $(".physically_handicapped_detail").addClass("d-none");
            }
        })
        .change();
    $("#gov_action")
        .change(function () {
            if ($(this).val() == "YES") {
                $(".gov_action_detail").removeClass("d-none");
            } else {
                $(".gov_action_detail").addClass("d-none");
            }
        })
        .change();
    $("#have_you_appeared_this_com")
        .change(function () {
            if ($(this).val() == "YES") {
                $(".have_you_appeared_this_com_detail").removeClass("d-none");
            } else {
                $(".have_you_appeared_this_com_detail").addClass("d-none");
            }
        })
        .change();
    $("#already_worked")
        .change(function () {
            if ($(this).val() == "YES") {
                $(".already_worked_detail").removeClass("d-none");
            } else {
                $(".already_worked_detail").addClass("d-none");
            }
        })
        .change();
    $("#any_diploma")
        .change(function () {
            if ($(this).val() == "YES") {
                $("#diploma_Wrapper").removeClass("d-none");
            } else {
                $("#diploma_Wrapper").addClass("d-none");
            }
        })
        .change();

    $("#any_other_graduation")
        .change(function () {
            if ($(this).val() == "YES") {
                $(".any_other_grd_wrapper").removeClass("d-none");
            } else {
                $(".any_other_grd_wrapper").addClass("d-none");
            }
        })
        .change();

    $("#personal_detail").validate({
        submitHandler: function (form, event) {
            event.preventDefault();
            let url = $("#personal_detail").data("url");
            var formData = new FormData(form);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $(".loader-wrapper").removeClass("d-none");
                    $(".success_message").html("");
                    $("#personal_btn").prop("disabled", true);
                },
                complete: function () {
                    $(".loader-wrapper").addClass("d-none");
                    $("#personal_btn").prop("disabled", false);
                },

                success: function (response) {
                    if (response.status == true) {
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            text: response.msg,
                            title: "Success",
                            showConfirmButton: true,
                        }).then(() => {
                            nexTab("pills-family-tab");
                        });
                    } else if (response.status == false) {
                        if (response.first_error) {
                            $("#" + response.first_error).focus();
                        }
                        if (response.errors) {
                            $.each(response.errors, function (key, value) {
                                $("#" + key).addClass("is-invalid");
                                $("." + key).removeClass("d-none");
                                $("." + key + "_msg").html(value);
                            });
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                text: response.msg,
                                title: "Error",
                                showConfirmButton: true,
                            });
                        }
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                    }
                },
                error: function (e) {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        text: e.responseJSON.message,
                        title: "Error",
                        showConfirmButton: true,
                    });
                },
            });
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
    });

    $("#family_detail").validate({
        submitHandler: function (form, event) {
            event.preventDefault();
            let url = $("#family_detail").data("url");
            var formData = new FormData(form);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $(".loader-wrapper").removeClass("d-none");
                    $(".success_message").html("");
                    $("#personal_btn").prop("disabled", true);
                },
                complete: function () {
                    $(".loader-wrapper").addClass("d-none");
                    $("#personal_btn").prop("disabled", false);
                },
                success: function (response) {
                    if (response.status == true) {
                        $("#pills-address-tab").prop("disabled", false);
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            text: response.msg,
                            title: "Success",
                            showConfirmButton: true,
                        }).then(() => {
                            nexTab("pills-address-tab");
                        });
                    } else if (response.status == false) {
                        if (response.first_error) {
                            $("#" + response.first_error).focus();
                        }
                        if (response.errors) {
                            $.each(response.errors, function (key, value) {
                                $("#" + key).addClass("is-invalid");
                                $("." + key).removeClass("d-none");
                                $("." + key + "_msg").html(value);
                            });
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                text: response.msg,
                                title: "Error",
                                showConfirmButton: true,
                            });
                        }
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                    }
                },
                error: function (e) {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        text: e.responseJSON.message,
                        title: "Error",
                        showConfirmButton: true,
                    });
                },
            });
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
    });

    $("#address_detail").validate({
        submitHandler: function (form, event) {
            event.preventDefault();
            let url = $("#address_detail").data("url");
            var formData = new FormData(form);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $(".loader-wrapper").removeClass("d-none");
                    $(".success_message").html("");
                    $("#personal_btn").prop("disabled", true);
                },
                complete: function () {
                    $(".loader-wrapper").addClass("d-none");
                    $("#personal_btn").prop("disabled", false);
                },
                success: function (response) {
                    if (response.status == true) {
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            text: response.msg,
                            title: "Success",
                            showConfirmButton: true,
                        }).then(() => {
                            nexTab("pills-education-tab");
                        });
                    } else if (response.status == false) {
                        if (response.first_error) {
                            $("#" + response.first_error).focus();
                        }
                        if (response.errors) {
                            $.each(response.errors, function (key, value) {
                                $("#" + key).addClass("is-invalid");
                                $("." + key).removeClass("d-none");
                                $("." + key + "_msg").html(value);
                            });
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                text: response.msg,
                                title: "Error",
                                showConfirmButton: true,
                            });
                        }
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                    }
                },
                error: function (e) {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        text: e.responseJSON.message,
                        title: "Error",
                        showConfirmButton: true,
                    });
                },
            });
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
    });
    
    $("#education_detail").validate({
        submitHandler: function (form, event) {
            event.preventDefault();
            let url = $("#education_detail").data("url");
            var formData = new FormData(form);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $(".loader-wrapper").removeClass("d-none");
                    $(".success_message").html("");
                    $("#personal_btn").prop("disabled", true);
                },
                complete: function () {
                    $(".loader-wrapper").addClass("d-none");
                    $("#personal_btn").prop("disabled", false);
                },
                success: function (response) {
                    if (response.status == true) {
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            text: response.msg,
                            title: "Success",
                            showConfirmButton: true,
                        }).then(() => {
                            nexTab("pills-work-experience-tab");
                        });
                    } else if (response.status == false) {
                        if (response.first_error) {
                            $("#" + response.first_error).focus();
                        }
                        if (response.errors) {
                            $.each(response.errors, function (key, value) {
                                $("#" + key).addClass("is-invalid");
                                $("." + key).removeClass("d-none");
                                $("." + key + "_msg").html(value);
                            });
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                text: response.msg,
                                title: "Error",
                                showConfirmButton: true,
                            });
                        }
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                    }
                },
                error: function (e) {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        text: e.responseJSON.message,
                        title: "Error",
                        showConfirmButton: true,
                    });
                },
            });
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
    });


    $("#work_detail").validate({
        submitHandler: function (form, event) {
            event.preventDefault();
            let url = $("#work_detail").data("url");
            var formData = new FormData(form);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $(".loader-wrapper").removeClass("d-none");
                    $(".success_message").html("");
                    $("#personal_btn").prop("disabled", true);
                },
                complete: function () {
                    $(".loader-wrapper").addClass("d-none");
                    $("#personal_btn").prop("disabled", false);
                },
                success: function (response) {
                    if (response.status == true) {
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            text: response.msg,
                            title: "Success",
                            showConfirmButton: true,
                        }).then(() => {
                            nexTab("pills-other-tab");
                        });
                    } else if (response.status == false) {
                        if (response.first_error) {
                            $("#" + response.first_error).focus();
                        }
                        if (response.errors) {
                            $.each(response.errors, function (key, value) {
                                $("#" + key).addClass("is-invalid");
                                $("." + key).removeClass("d-none");
                                $("." + key + "_msg").html(value);
                            });
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                text: response.msg,
                                title: "Error",
                                showConfirmButton: true,
                            });
                        }
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                    }
                },
                error: function (e) {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        text: e.responseJSON.message,
                        title: "Error",
                        showConfirmButton: true,
                    });
                },
            });
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
    });


    $("#other_info_detail").validate({
        submitHandler: function (form, event) {
            event.preventDefault();
            let url = $("#other_info_detail").data("url");
            var formData = new FormData(form);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $(".loader-wrapper").removeClass("d-none");
                    $(".success_message").html("");
                    $("#personal_btn").prop("disabled", true);
                },
                complete: function () {
                    $(".loader-wrapper").addClass("d-none");
                    $("#personal_btn").prop("disabled", false);
                },
                success: function (response) {
                    if (response.status == true) {
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            text: response.msg,
                            title: "Success",
                            showConfirmButton: true,
                        }).then(() => {
                            nexTab("pills-document-tab");
                        });
                    } else if (response.status == false) {
                        if (response.first_error) {
                            $("#" + response.first_error).focus();
                        }
                        if (response.errors) {
                            $.each(response.errors, function (key, value) {
                                $("#" + key).addClass("is-invalid");
                                $("." + key).removeClass("d-none");
                                $("." + key + "_msg").html(value);
                            });
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                text: response.msg,
                                title: "Error",
                                showConfirmButton: true,
                            });
                        }
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                    }
                },
                error: function (e) {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        text: e.responseJSON.message,
                        title: "Error",
                        showConfirmButton: true,
                    });
                },
            });
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
    });

    $("#doc_detail").validate({
        rules: {
            pancard: {
                extension: "jpg|jpeg|png",
            },
            aadhar_card_back: {
                 extension: "jpg|jpeg|png",
            },
            aadhar_card_front: {
                 extension: "jpg|jpeg|png",
            },
            iti_certificate: {
                 extension: "jpg|jpeg|png",
            },
            twelve_certificate: {
                 extension: "jpg|jpeg|png",
            },
            tenth_certificate: {
                 extension: "jpg|jpeg|png",
            },
            passport_photo: {
                 extension: "jpg|jpeg|png",
            },
            other_graduation_file: {
                extension: "jpg|jpeg|png",
           },
        },
        submitHandler: function (form, event) {
            event.preventDefault();
            let url = $("#doc_detail").data("url");
            var formData = new FormData(form);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $(".loader-wrapper").removeClass("d-none");
                    $(".success_message").html("");
                    $("#personal_btn").prop("disabled", true);
                },
                complete: function () {
                    $(".loader-wrapper").addClass("d-none");
                    $("#personal_btn").prop("disabled", false);
                },
                success: function (response) {
                    if (response.status == true) {
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            text: response.msg,
                            title: "Success",
                            showConfirmButton: true,
                        }).then(() => {
                            if (response.redirect_url) {
                                window.location.replace(response.redirect_url);
                            }
                        });
                    } else if (response.status == false) {
                        if (response.first_error) {
                            $("#" + response.first_error).focus();
                        }
                        if (response.errors) {
                            $.each(response.errors, function (key, value) {
                                $("#" + key).addClass("is-invalid");
                                $("." + key).removeClass("d-none");
                                $("." + key + "_msg").html(value);
                            });
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                text: response.msg,
                                title: "Error",
                                showConfirmButton: true,
                            });
                        }
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                    }
                },
                error: function (e) {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        text: e.responseJSON.message,
                        title: "Error",
                        showConfirmButton: true,
                    });
                },
            });
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
    });
    
    $("#eligibility_status").validate({
        submitHandler: function (form, event) {
            event.preventDefault();
            let url = $("#eligibility_status").data("url");
            var formData = new FormData(form);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $(".loader-wrapper").removeClass("d-none");
                    $(".success_message").html("");
                    $("#personal_btn").prop("disabled", true);
                },
                complete: function () {
                    $(".loader-wrapper").addClass("d-none");
                    $("#personal_btn").prop("disabled", false);
                },
                success: function (response) {
                    if (response.status == true) {
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            text: response.msg,
                            title: "Success",
                            showConfirmButton: true,
                        });
                    } else if (response.status == false) {
                        if (response.first_error) {
                            $("#" + response.first_error).focus();
                        }
                        if (response.errors) {
                            $.each(response.errors, function (key, value) {
                                $("#" + key).addClass("is-invalid");
                                $("." + key).removeClass("d-none");
                                $("." + key + "_msg").html(value);
                            });
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                text: response.msg,
                                title: "Error",
                                showConfirmButton: true,
                            });
                        }
                        if (response.success_input) {
                            $.each(
                                response.success_input,
                                function (key, value) {
                                    $("#" + value).removeClass("is-invalid");
                                    $("." + value).addClass("d-none");
                                    $("." + value + "_msg").html("");
                                }
                            );
                        }
                    }
                },
                error: function (e) {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        text: e.responseJSON.message,
                        title: "Error",
                        showConfirmButton: true,
                    });
                },
            });
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
    });
});
