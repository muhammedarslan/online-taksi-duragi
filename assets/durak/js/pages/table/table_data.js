
$(document).ready(function() {
 'use strict';

 $('#table tfoot th').each( function () {
  var title = $(this).text();
  if ( title == '-' ) {
    $(this).html( '<input type="text" class="form-control" disabled="" />' );
  } else {
    $(this).html( '<input type="text" class="form-control" placeholder="'+title+'" />' );
  }
} );



 var table =  $('#table').DataTable( {
   "pageLength": 100,
   "bLengthChange" : false,
   "language": {
    "emptyTable": "Gösterilecek veri bulunamadı.",
    "processing": "Veriler yükleniyor",
    "sDecimal": ".",
    "sInfo": "Toplam _TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor.",
    "sInfoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "Tabloda  _MENU_  kayıt göster",
    "sLoadingRecords": "Yükleniyor...",
    "sSearch": "Ara:",
    "sZeroRecords": "Eşleşen kayıt bulunamadı",
    "oPaginate": {
      "sFirst": "İlk",
      "sLast": "Son",
      "sNext": "Sonraki",
      "sPrevious": "Önceki"
    },
    "oAria": {
      "sSortAscending": ": artan sütun sıralamasını aktifleştir",
      "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
    },
    "select": {
      "rows": {
        "_": "%d kayıt seçildi",
        "0": "",
        "1": "1 kayıt seçildi"
      }
    }
  }
} );

 

 table.columns().every( function () {
  var that = this;

  $( 'input', this.footer() ).on( 'keyup change', function () {
    if ( that.search() !== this.value ) {
      that
      .search( this.value )
      .draw();
    }
  } );
} );


} );