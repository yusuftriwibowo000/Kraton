// var inputBayar = document.getElementById('inputBayar');
//     inputBayar.addEventListener('keyup', function(e)
//     {
//         inputBayar.value = formatRupiah(this.value);
//     });

// 	function formatRupiah(angka, prefix)
//     {
//         var number_string = angka.replace(/[^,\d]/g, '').toString(),
//             split    = number_string.split(','),
//             sisa     = split[0].length % 3,
//             rupiah     = split[0].substr(0, sisa),
//             ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
//         if (ribuan) {
//             separator = sisa ? '.' : '';
//             rupiah += separator + ribuan.join('.');
//         }
        
//         rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
//         return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
//     }
$(document).ready(function () {
	var baseUrl = $("#baseUrl").data("url");
	$(".datatable").DataTable();
	$(".select2").select2();
	$(".datepicker").datepicker({
		format: "yyyy/mm/dd",
	});
	$("button[type='reset']").click(function () {
		$(".select2").val(null).trigger("change");
	});
	$(".custom-file-input").on("change", function () {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});

	$(".submitConfirm").submit(function (e) {
		var id = $(this).attr("id");
		e.preventDefault();
		swal(
			{
				title: "Validasi Judul",
				text: "Apakah anda yakin untuk memvalidasi tugas akhir ini?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Perbarui",
				closeOnConfirm: false,
			},
			function () {
				$("#" + id)
					.unbind("submit")
					.submit();
			}
		);
	});
	$(".confirm").click(function (e) {
		e.preventDefault();
		var url = $(this).attr("href");
		swal(
			{
				title: "Data Akan Dihapus",
				text: "Apakah anda yakin untuk menghapus data ini?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Hapus",
				closeOnConfirm: false,
			},
			function () {
				window.location = url;
			}
		);
	});
	$(".openModal").click(function (e) {
		e.preventDefault();
		var url = $(this).attr("href");
		$.ajax({
			url: url,
			success: function (data) {
				$(".place-modal").html(data);
				$(".modalJS").modal("show");
			},
		});
	});
	function setHarga(thisParam) {
		var thisVal = thisParam.find(":selected").data("idr");
		var target = thisParam.data("target");
		console.log(thisVal)
		console.log(target)
		$(target).val(thisVal);
	}
	$(".setHarga").change(function () {
		setHarga($(this));
	});
	function removeField(thisParam){
		var target = thisParam.data("target");
		var counting = parseInt($(".loop-detail").attr("data-counting"));
		counting--;
		$(".loop-detail").attr("data-counting", counting);
		$(".detail-field[data-id='" + target + "']").remove();
		$("#total").html(rupiah(getTotal()));
	}
	$(".removeField").click(function (e) {
		e.preventDefault();
		removeField($(this))
	});

	$(".addDetail").click(function (e) {
		e.preventDefault();
		var url = $(this).attr("href");
		var counting = parseInt($(".loop-detail").attr("data-counting"));
		counting++;

		$.ajax({
			url: url,
			method: "get",
			data: { counting: counting },
			success: function (data) {
				$(".loop-detail").append(data);
				$(".loop-detail").attr("data-counting", counting);
				$(".removeField").click(function (e) {
					e.preventDefault();
					removeField($(this))
				});
				$(".select2").select2();
				$(".qtyHarga").keyup(function () {
					qtyHarga($(this));
				});
				$(".setHarga").change(function () {
					setHarga($(this));
				});
			},
		});
	});
	function qtyHarga(thisParam) {
		var id = "#" + thisParam.attr("id");
		var parent = thisParam.data("parent");
		var subtotal = thisParam.data("subtotal");

		var thisVal = parseInt($(id).val());
		thisVal = isNaN(thisVal) ? 0 : thisVal;
		var parentVal = parseInt($(parent).val());
		var subtotalVal = thisVal * parentVal;
		subtotalVal = isNaN(subtotalVal) ? thisVal : subtotalVal;
		$(subtotal).val(subtotalVal);
		$("#total").html(rupiah(getTotal()));
	}
	
	function getKembalian(){
		var total = $("#inputBayar").val()
		var total2 = total.replace(/[,{\}\[\]/]/gi,'')
		var totalBayar = parseInt(total2)
		// var potongan = parseInt($("#inputPotongan").val())
		var htmlTotal = $("#total").html()
		if(htmlTotal!='0'){
			var	kembalian = totalBayar - getPotongan();
			return parseInt(kembalian)
		}
	}
	function getTotal() {
		var total = 0;
		$(".subtotal").each(function () {
			total = total + parseInt($(this).val());
		});
		return parseInt(total);
	}
	function getPotongan(){
		var potong = $("#inputPotongan").val()
		var potong2 = potong.replace(/[,{\}\[\]/]/gi,'')
		var potongan = parseInt(potong2)
		// var potongan = parseInt($("#inputPotongan").val())
		var htmlTotal = $("#total").html()
		if(htmlTotal!='0'){
			var total =  getTotal() - potongan

			return parseInt(total);
		}
 	}

	 //format uang rupiah
	$("#inputBayar").keyup(function(e){
        $(this).val(formatRupiah($(this).val()));
    });

	  //potongan harga
	$("#inputPotongan").keyup(function(){
        $(this).val(formatRupiah($(this).val()));
    });
	 
	  //total kembalian
	$(".totalKembalian").keyup(function(){
		if($(this).val()!=''){
			$("#total").html(rupiah(getPotongan()));
			$("#kembalian").html(rupiah(getKembalian()));
		}
	})
	
	//qty harga
	$(".qtyHarga").keyup(function () {
		qtyHarga($(this));
			$("#total").html(rupiah(getPotongan()));
			$("#kembalian").html(rupiah(getKembalian()));
	});

	function rupiah(nominal) {
		var reverse = nominal.toString().split("").reverse().join(""),
			ribuan = reverse.match(/\d{1,3}/g);
		ribuan = ribuan.join(".").split("").reverse().join("");
		if(nominal<0){
			ribuan = "-"+ribuan;
		}

		// Cetak hasil
		return ribuan;
	}

	// function formatRupiah(nominal) {
		var formatRupiah = function(num){
			var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
			if(str.indexOf(".") > 0) {
			  parts = str.split(".");
			  str = parts[0];
			}
			str = str.split("").reverse();
			for(var j = 0, len = str.length; j < len; j++) {
			  if(str[j] != ",") {
				output.push(str[j]);
				if(i%3 == 0 && j < (len - 1)) {
				  output.push(",");
				}
				i++;
			  }
			}
			formatted = output.reverse().join("");
			return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
		  };
	// }

	$(".labaRugiFilter").change(function(){
		var thisVal = $(this).val();
		var other = $(this).data('other')
		var otherVal = $(other).val()

		if(thisVal!='' && otherVal!=''){
			var dataPost;
			if(other=='#tahun'){
				dataPost = {bulan : thisVal, tahun : otherVal}
			}
			else{
				dataPost = {tahun : thisVal, bulan : otherVal}
			}
			$.ajax({
				type : 'post',
				data : dataPost,
				url : 'getLabarugi',
				success : function(data){
					$("#penjualan").html(rupiah(parseInt(data.penjualan)))
					$("#potonganPenjualan").html(rupiah(parseInt(data.potongan_penjualan)))
					$("#return").html(rupiah(parseInt(data.return_penjualan)))
					$("#totalPenjualan").html(rupiah(parseInt(data.total_penjualan)))
					$("#pembelian").html(rupiah(parseInt(data.pembelian)))
					$("#potongan").html(rupiah(parseInt(data.potongan_penjualan)))
					$("#returnPembelian").html(rupiah(parseInt(data.return_pembelian)))
					$("#pembelianBersih").html(rupiah(parseInt(data.pembelian_bersih)))
					$("#persediaanAwal").html(rupiah(parseInt(data.persediaan_awal)))
					$("#total").html(rupiah(parseInt(data.total_persediaan)))
					$("#persediaanAkhir").html(rupiah(parseInt(data.persediaan_akhir)))
					$("#hpp").html(rupiah(parseInt(data.hpp)))
					$("#labaRugi").html(rupiah(parseInt(data.laba_rugi)))
				}
			})
		}
	})
	$(".editRemoveField").click(function(e){
		e.preventDefault()
		var id = $(this).data('id')
		$("#total").html(rupiah(getPotongan()));
		$("#kembalian").html(rupiah(getKembalian()));

		$(".deletedId").append(`<input type='hidden' name='id_delete[]' value='${id}'>`)
	})
});
