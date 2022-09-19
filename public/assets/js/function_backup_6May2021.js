(function ($) {
	$.fn.inputFilter = function (inputFilter) {
		return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
			if (inputFilter(this.value)) {
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
			} else if (this.hasOwnProperty("oldValue")) {
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			}
		});
	};
}(jQuery));

function show_loading() {
	var ini = $(".loading_overlay");

	ini.css("display", "block");
	ini.css("opacity", 1);
}

function hide_loading() {
	var ini = $(".loading_overlay");
	var val = 0;

	let fadeEffect = setInterval(() => {
		if (ini.css("opacity") > 0) {
			val = ini.css("opacity");
			val -= 0.1;
			ini.css("opacity", val);
		} else {
			clearInterval(fadeEffect)
			ini.css("display", "none");
		}
	}, 100)
}

function currency(val) {
	return val.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
}

function readURL(input) {
	$('#editimagePreview').css('background-image', 'url(' + base_url + input + ')');
	$('#smallprofil').attr("src", base_url + input);
	$('#editimagePreview').hide();
	$('#smallprofil').hide();
	$('#editimagePreview').fadeIn(650);
	$('#smallprofil').fadeIn(650);
}

function calctotalprice(val) {
	var price = $('#' + val + 'val').attr('value');
	//var disc = $('#diskon').attr('value');

	$('#price').text(currency(price));

	if (val == 'tahun') {
		if ($('#diskon').length) {
			$('#befdisc').text('Rp. ' + currency(price));
			price = $('#disctahun').attr('value');
			$('#afterdisc').text(currency(price));
		}

		var total = currency(price);

		$('#bultah').text('Tahunan');
		$('#bultah2').text('Tahun');
		$('#tblth').text('thn');
		$('#total').text(total);
	} else if (val == 'bulan') {
		if ($('#diskon').length) {
			$('#befdisc').text('Rp. ' + currency(price));
			price = $('#discbulan').attr('value');
			$('#afterdisc').text(currency(price));
		}

		var total = currency(price);

		$('#bultah').text('Bulanan');
		$('#bultah2').text('Bulan');
		$('#tblth').text('bln');
		$('#total').text(total);
	}
}

function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

function checkPassword() {
	if ($('#password').val() != $('#repeat').val()) {
		return false;
	} else {
		return true;
	}
}

function failmessage(readyState) {
	if (readyState == 4) {
		Swal.fire('PHP Error', 'PHP error ocurred, please contact administrator', 'error');
		// HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
	}
	else if (readyState == 0) {
		Swal.fire('Connection Error', "Can't establish a connection to the server, please check your internet connection", 'error');
		// Network error (i.e. connection refused, access denied due to CORS, etc.)
	}
	else {
		Swal.fire('Failed to get Data', 'Failed to get data, please contact administrator', 'error');
	}
}

$(document).ready(function () {

	if ($.fn.DataTable) {
		$('#tablesaktiresult').DataTable({
			"order": [],
		});
	}

	$(document).on('click', '#daftarsekarang', function () {
		$('#register').modal('toggle');
		$('#login').modal('hide');
	});

	$(document).on('click', '#masuksekarang', function () {
		$('#login').modal('toggle');
		$('#register').modal('hide');
	});

	$(document).on('change', '#regiskomunitas', function () {
		if ($(this).checked) {
			$("#clientid").prop('required', true);
		} else {
			$("#clientid").prop('required', false);
		}
	});

	$(document).on('change', '#regiskoperasi', function () {
		if ($(this).checked) {
			$("#emailid").prop('required', true);
		} else {
			$("#emailid").prop('required', false);
		}
	});

	$(document).on('keyup', '#email', function () {
		var val = $(this).val();
		var input = this;

		if (!isEmail(val)) {
			this.setCustomValidity('Please Insert Valid Email !!');
		} else {
			$.ajax({
				url: base_url + 'email_check',
				type: 'POST',
				dataType: 'JSON',
				data: {
					email: val,
				},
				beforeSend: function () {

				}
			})
				.done(function (res) {
					if (res.valid) {
						input.setCustomValidity('');
					} else {
						input.setCustomValidity('Email Already Registered!!');
					}
				})
				.fail(function (XMLHttpRequest, textStatus, errorThrown) {
					failmessage(XMLHttpRequest.readyState);
				});
		}
	});

	$(document).on('keyup', '#repeat, #password', function () {
		if (checkPassword()) {
			$("#repeat").get(0).setCustomValidity('');
			$("#password").get(0).setCustomValidity('');
		} else {
			$("#repeat").get(0).setCustomValidity('Password Missmatch');
			$("#password").get(0).setCustomValidity('Password Missmatch');
		}
	});

	$(document).on('click', '#markallread', function () {
		var list = [];

		$('#nav-home li').each(function () {
			var ini = $(this);

			if (ini.hasClass("noread")) {
				var itemId = ini.attr('id');
				ini.removeClass("noread");

				list.push({
					itemId: itemId,
				});
			}
		});

		$('#nav-profile li').each(function () {
			var ini = $(this);

			if (ini.hasClass("noread")) {
				var itemId = ini.attr('id');
				ini.removeClass("noread");

				list.push({
					itemId: itemId,
				});
			}
		});

		$('#ntftotal').remove();

		if (list.length > 0) {
			$.ajax({
				url: base_url + 'markallread',
				type: 'POST',
				dataType: 'JSON',
				data: {
					list: list,
				},
				beforeSend: function () {

				}
			})
				.done(function (res) {
					if (res.success == 1) {

					} else {

					}
				})
				.fail(function (XMLHttpRequest, textStatus, errorThrown) {

				});
		}
	});

	$(document).on('click', '#refcodebut', function () {
		var ini = $(this);
		var ref = $('#referal').val();

		$.ajax({
			url: base_url + 'refcode',
			type: 'POST',
			dataType: 'JSON',
			data: {
				ref: ref,
			},
			beforeSend: function () {

			}
		})
			.done(function (res) {
				if (res.success == 1) {
					ini.addClass("ref-green");
					Swal.fire(res.reason, res.description, 'success');
				} else {
					ini.removeClass("ref-green");
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {

			});
	});

	$(document).on('submit', '#registrationForm', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'daftar_baru',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					Swal.fire(res.reason, res.description, 'success');
					ini.trigger("reset");
					$('#register').modal('hide');
					$('#login').modal('toggle');
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('submit', '#formlogin', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'login',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					window.location.replace(base_url);
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('submit', '#formforget', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'forgetpass',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					Swal.fire(res.reason, res.description, 'success').then((value) => {
						window.location.replace(base_url);
					});
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('submit', '#changepass', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'submitforgetpass',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					Swal.fire(res.reason, res.description, 'success').then((value) => {
						window.location.replace(base_url);
					});
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('submit', '#formuserpass', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'submituserpass',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					ini.trigger("reset");
					Swal.fire(res.reason, res.description, 'success');
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});


	$(document).on('submit', '#showchart', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'showchart',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					$("#defchartpic").hide();
					$("#tempatchart").empty();
					$("#tempatchart").append(res.result);
				} else {
					$("#tempatchart").empty();
					$("#defchartpic").show();
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});
	
	$(document).on('submit', '#mshowchart', function (e) {
		e.preventDefault();
		var ini = $(this);
		$.ajax({
			url: base_url + 'mshowchart',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					$("#defchartpic").hide();
					$("#tempatchart").empty();
					$("#tempatchart").append(res.result);
				} else {
					$("#tempatchart").empty();
					$("#defchartpic").show();
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('submit', '#showtable', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'showtable',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					$("#defchartpic").hide();
					$("#tempattabel").empty();
					$("#tempattabel").append(res.result);
					$('#tempattabel table').DataTable();
				} else {
					$("#tempattabel").empty();
					$("#defchartpic").show();
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});
	
	$(document).on('submit', '#mshowtable', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'mshowtabel',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					$("#defchartpic").hide();
					$("#tempattabel").empty();
					$("#tempattabel").append(res.result);
					$('#tempattabel table').DataTable();
				} else {
					$("#tempattabel").empty();
					$("#defchartpic").show();
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('click', 'input[type=radio][name=langganan]', function () {
		var val = $(this).val();
		calctotalprice(val);
	});

	$(document).on('submit', '#formpembayaran', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'processpayment',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		})
			.done(function (res) {
				hide_loading();
				if (res.success == 1) {
					snap.pay(res.token, {
						onSuccess: function (result) {
							Swal.fire('Payment Success!', 'payment success!', 'success').then((value) => {
								window.location.replace(base_url);
							});
						},
						onPending: function (result) {
							Swal.fire('Payment Pending!', 'wating your payment!', 'warning').then((value) => {
								window.location.replace(base_url);
							});
						},
						onError: function (result) {
							Swal.fire('Payment Failed!', 'payment failed!', 'error');
						},
						onClose: function () {
							Swal.fire('Payment Canceled!', 'you closed the popup without finishing the payment', 'warning');
						}
					});
				} else {
					Swal.fire(res.reason, res.description, 'error');
				}
			})
			.fail(function (XMLHttpRequest, textStatus, errorThrown) {
				hide_loading();
				failmessage(XMLHttpRequest.readyState);
			});
	});

	$(document).on('submit', '#formtable', function (e) {
		e.preventDefault();
		var ini = $(this);

		var start = $('#startdate').val();
		var finish = $('#enddate').val();

		if ((start && finish) && (new Date(start) <= new Date(finish))) {
			$.ajax({
				url: base_url + 'getdatasakti',
				type: 'POST',
				dataType: 'JSON',
				data: ini.serialize(),
				beforeSend: function () {
					show_loading();
				}
			})
				.done(function (res) {
					hide_loading();
					if (res.success == 1) {
						$('#tablesaktiresult').DataTable().destroy();
						$('#tablesaktiresult').DataTable().clear().draw();
						$('#tablesaktiresult').DataTable().rows.add($(res.data)).draw();
					} else {
						$('#tablesaktiresult').DataTable().destroy();
						$('#tablesaktiresult').DataTable().clear().draw();
						Swal.fire(res.reason, res.description, 'error');
					}
				})
				.fail(function (XMLHttpRequest, textStatus, errorThrown) {
					hide_loading();
					failmessage(XMLHttpRequest.readyState);
				});
		} else {
			Swal.fire('Date Invalid', 'Silahkan isi tanggal terlebih dahulu', 'error');
		}
	});

	$(document).on('submit', '#formtablem', function (e) {
		e.preventDefault();
		var ini = $(this);

		var start = $('#startdate').val();
		var finish = $('#enddate').val();

		if ((start && finish) && (new Date(start) <= new Date(finish))) {
			$.ajax({
				url: base_url + 'getdatasaktim',
				type: 'POST',
				dataType: 'JSON',
				data: ini.serialize(),
				beforeSend: function () {
					show_loading();
				}
			})
				.done(function (res) {
					hide_loading();
					if (res.success == 1) {
						// $('#tablesaktiresult').DataTable().destroy();
						// $('#tablesaktiresult').DataTable().clear().draw();
						// $('#tablesaktiresult').DataTable().rows.add($(res.data)).draw();
						document.getElementById("tablesaktiresultm").innerHTML += res.data;
					} else {
						// $('#tablesaktiresult').DataTable().destroy();
						// $('#tablesaktiresult').DataTable().clear().draw();
						Swal.fire(res.reason, res.description, 'error');
					}
				})
				.fail(function (XMLHttpRequest, textStatus, errorThrown) {
					hide_loading();
					failmessage(XMLHttpRequest.readyState);
				});
		} else {
			Swal.fire('Date Invalid', 'Silahkan isi tanggal terlebih dahulu', 'error');
		}
	});

	$(document).on('click', '#tabledownload', function (e) {
		e.preventDefault();
		var ini = $(this);

		var file = ini.attr('value');

		window.location.href = base_url + '/backend/public/assets/files/tabel_sakti/' + file;
	});

	$(document).on('keyup paste', '#mybio', function () {
		var ini = $(this);

		ini.val(ini.val().substring(0, 160));
		var tlength = ini.val().length;
		remain = 160 - parseInt(tlength);
		$('#mybio').text(remain);
	});

	$(document).on('keyup paste', '#username', function () {
		var ini = $(this);
		var input = this;

		ini.inputFilter(function (value) {
			return /^[A-z0-9]*$/i.test(value);
		});

		if (ini.val().length > 7) {
			ini.val(ini.val().substring(0, 12));
			var tlength = ini.length;
			var remain = 12 - parseInt(tlength);
			$('#username').text(remain);
			var val = ini.val();

			$.ajax({
				url: base_url + 'username_check',
				type: 'POST',
				dataType: 'JSON',
				data: {
					username: val,
				},
				beforeSend: function () {

				}
			}).done(function (res) {
				if (res.valid) {
					input.setCustomValidity('');
				} else {
					input.setCustomValidity('Username Already Registered!!');
				}
			}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
				failmessage(XMLHttpRequest.readyState);
			});
		} else {
			input.setCustomValidity('At least 8 Character');
		}
	});

	$(document).on('submit', '#profilupdate', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'updateprofil',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				Swal.fire(res.reason, res.description, 'success');
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('change', '#imageUpload', function (e) {
		var file_data = $('#imageUpload').prop('files')[0];
		var form_data = new FormData();
		form_data.append('file', file_data);

		$.ajax({
			url: base_url + 'updatephoto',
			type: 'POST',
			dataType: 'JSON',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				readURL(res.path);
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('change', '#connect_komu', function () {
		var ini = $(this);
		var val = ini.val();

		if (ini.is(':checked')) {
			if (val == '') {
				$('#komunitasmodal').modal('toggle');
			}
		}
	});

	$('#komunitasmodal').on('hidden.bs.modal', function () {
		var val = $('#connect_komu').val();

		if (val == '') {
			$('#connect_komu').prop('checked', false);
		}
	})

	$(document).on('submit', '#connectkomu_form', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'komuconnect',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				$('#connect_komu').val('connected');
				$('#komu_stats').text('Connected');
				$('#komunitasmodal').modal('toggle');

				Swal.fire(res.reason, res.description, 'success');
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});

	$(document).on('change', '#connect_kope', function () {
		var ini = $(this);
		var val = ini.val();

		if (ini.is(':checked')) {
			if (val == '') {
				$('#anggotamodal').modal('toggle');
			}
		}
	});

	$('#anggotamodal').on('hidden.bs.modal', function () {
		var val = $('#connect_kope').val();

		if (val == '') {
			$('#connect_kope').prop('checked', false);
		}
	})

	$(document).on('submit', '#connectkope_form', function (e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: base_url + 'kopeconnect',
			type: 'POST',
			dataType: 'JSON',
			data: ini.serialize(),
			beforeSend: function () {
				show_loading();
			}
		}).done(function (res) {
			hide_loading();
			if (res.success == 1) {
				$('#connect_kope').val('connected');
				$('#kope_stats').text('Connected');
				$('#anggotamodal').modal('toggle');

				Swal.fire(res.reason, res.description, 'success');
			} else {
				Swal.fire(res.reason, res.description, 'error');
			}
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			hide_loading();
			failmessage(XMLHttpRequest.readyState);
		});
	});
});

//awal contact
$(document).ready(function () {
	$('.Formcontact').submit(function (e) {
		e.preventDefault();

		$.ajax({
			type: "post",
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: "json",
			beforeSend: function () {
				$('#btnsend').prop('disabled', true);
				$('#btnsend').html('<i class="fa fa-spin fa-spinner"></i> Processing');
			},
			complete: function () {
				$('#btnsend').prop('disabled', false);
				$('#btnsend').html('Simpan');
			},
			success: function (response) {
				if (response.error) {

				}
				else {
					Swal.fire(
						'Pemberitahuan',
						response.success.data,
						'success',
					).then(function () {
						/* $('#nama').val('');
						$('#email').val('');
						$('#phone').val(''); */
						window.location.href = response.success.link;
					});
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});
	});
});
//ahir

//awal Subscribe
$(document).ready(function () {
	$('.formSubscribe').submit(function (e) {
		e.preventDefault();

		$.ajax({
			type: "post",
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: "json",
			beforeSend: function () {
				$('#btn_subscribe').prop('disabled', true);
				$('#btn_subscribe').html('<i class="fa fa-spin fa-spinner"></i> Processing');
			},
			complete: function () {
				$('#btn_subscribe').prop('disabled', false);
				$('#btn_subscribe').html('Simpan');
			},
			success: function (response) {
				if (response.error) {
					Swal.fire(
						'Pemberitahuan',
						response.error.input_subscribe,
						'error',
					).then(function () {
						/* $('#nama').val('');
						$('#email').val('');
						$('#phone').val(''); */
						//window.location.href = response.success.link;
					});
				}
				else {
					Swal.fire(
						'Pemberitahuan',
						response.success.subscribe_footer,
						'success',
					).then(function () {
						$('#input_subscribe').val('');
						/* $('#email').val('');
						$('#phone').val(''); */
					});
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
			}
		});
	});
});
//ahir Subscribe

