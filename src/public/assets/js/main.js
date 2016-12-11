/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */
 ;(function($, undefined) {

  /**
   * Ação do botão flutuante de add
   */
  $('.btn-add').on('click', function() {
    var default_controller = '/contact';
    if (/^\/contact/.test(location.pathname)) {
      if (!/^\/contact\/add\/?/.test(location.pathname)) {
        location.href = '/contact/add';
      }
    } else if (/^\/organization/.test(location.pathname)) {
      if (!/^\/organization\/add\/?/.test(location.pathname)) {
        location.href = '/organization/add';
      }
    } else {
      location.href = default_controller + '/add';
    }
  });

  /**
   * Deixa ativado a opção no menu de acordo com o controller
   */
  var navbar = $('.navbar .navbar-nav');
  if (/^\/contact/.test(location.pathname)) {
    navbar.find('li').first().addClass('active');
  } else if (/^\/organization/.test(location.pathname)) {
    navbar.find('li').last().addClass('active');
  }

  /**
   * Formata as datas
   */
  $('.datetime').each(function(i, e) {
    $(e).attr('data-default', $(e).text());
    $(e).text(new Date($(e).text().replace(/\s/, 'T')).toLocaleString());
  });

  /**
   * Ação do botão add telefone no formulário de contatos
   */
  $('.btn-add-phone').on('click', function btn_add_phone() {
    var i = 0;
    do {
      i++;
    } while ($('#box_phone_' + i).length);
    var html = '';
    html += '<div class="row" id="box_phone___i__">';
    html += '  <div class="col-xs-12 col-md-4">';
    html += '        <div class="form-group">';
    html += '          <label for="phone___i__" class="col-md-3 control-label">Telefone</label>';
    html += '          <div class="col-md-9">';
    html += '            <input type="tel" class="form-control" id="phone___i__" name="phone[]" placeholder="Telefone" maxlength="16">';
    html += '          </div>';
    html += '        </div>';
    html += '    </div>';
    html += '    <div class="col-xs-12 col-md-3">';
    html += '        <div class="form-group">';
    html += '          <label for="phone_type___i__" class="col-md-2 control-label">Tipo</label>';
    html += '          <div class="col-md-10">';
    html += '            <select id="phone_type___i__" name="phone_type_id[]" class="form-control">';
    html += '                <option value="1">Residencial</option>';
    html += '                <option value="2">Celular</option>';
    html += '                <option value="3">Trabalho</option>';
    html += '            </select>';
    html += '          </div>';
    html += '        </div>';
    html += '    </div>';
    html += '    <div class="col-xs-7 col-xs-offset-1 col-md-3 col-md-offset-0">';
    html += '        <div class="form-group">';
    html += '          <div class="radio radio-primary">';
    html += '            <label>';
    html += '              <input type="radio" name="primary_phone_id" value="__i__"> Principal';
    html += '            </label>';
    html += '          </div>';
    html += '        </div>';
    html += '    </div>';
    html += '    <div class="col-xs-4 col-md-2">';
    html += '        <div class="form-group">';
    html += '            <a href="javascript:void(0)" class="btn btn-primary btn-del-phone" data-target="#box_phone___i__">';
    html += '                <i class="material-icons" style="color: #fe6363">&#xE15D;</i>';
    html += '            </a>';
    html += '        </div>';
    html += '    </div>';
    html += '</div>';
    $('.after_phones').before(html.replace(/__i__/g, i));
    $.material.init();
    $('.btn-del-phone').unbind('click', btn_del_phone);
    $('.btn-del-phone').bind('click', btn_del_phone);
    $($('#box_phone_' + i + ' input')[0]).focus();
  });

  /**
   * Ação do botão del telefone no formulário de contatos
   */
  function btn_del_phone() {
    if (confirm('Certeza que quer remover este campo de telefone?')) {
      var target = $(this).data('target');
      var checked = $('[type=radio]', target).is(':checked');
      $(target).remove();
      if (checked) {
        var radio = $('[name=primary_phone_id]');
        radio.length && $(radio[0]).prop('checked', true);
      }
    }
  }
  $('.btn-del-phone').on('click', btn_del_phone);

  /**
   * Ação do botão add email no formulário de contatos
   */
  $('.btn-add-email').on('click', function btn_add_email() {
    var i = 0;
    do {
      i++;
    } while ($('#box_email_' + i).length);
    var html = '';
    html += '<div class="row" id="box_email___i__">';
    html += '    <div class="col-xs-12 col-md-6">';
    html += '        <div class="form-group">';
    html += '          <label for="email___i__" class="col-md-2 control-label">Email</label>';
    html += '          <div class="col-md-10">';
    html += '            <input type="email" class="form-control" id="email___i__" name="email[]" placeholder="Email" maxlength="256">';
    html += '          </div>';
    html += '        </div>';
    html += '    </div>';
    html += '    <div class="col-xs-7 col-xs-offset-1 col-md-4 col-md-offset-0">';
    html += '        <div class="form-group">';
    html += '          <div class="radio radio-primary">';
    html += '            <label>';
    html += '              <input type="radio" name="primary_email_id" value="__i__"> Principal';
    html += '            </label>';
    html += '          </div>';
    html += '        </div>';
    html += '    </div>';
    html += '    <div class="col-xs-4 col-md-2">';
    html += '        <div class="form-group">';
    html += '            <a href="javascript:void(0)" class="btn btn-primary btn-del-email" data-target="#box_email___i__">';
    html += '                <i class="material-icons" style="color: #fe6363">&#xE15D;</i>';
    html += '            </a>';
    html += '        </div>';
    html += '    </div>';
    html += '</div>';
    $('.after_emails').before(html.replace(/__i__/g, i));
    $.material.init();
    $('.btn-del-email').unbind('click', btn_del_email);
    $('.btn-del-email').bind('click', btn_del_email);
    $($('#box_email_' + i + ' input')[0]).focus();
  });

  /**
   * Ação do botão del email no formulário de contatos
   */
  function btn_del_email() {
    if (confirm('Certeza que quer remover este campo de email?')) {
      var target = $(this).data('target');
        var checked = $('[type=radio]', target).is(':checked');
        $(target).remove();
        if (checked) {
          var radio = $('[name=primary_email_id]');
          radio.length && $(radio[0]).prop('checked', true);
        }
    }
  }
  $('.btn-del-email').on('click', btn_del_email);

  /**
   * Limpa o id da organização selecionada se o campo de buscas for apagado
   */
  $('#organization_search').on('keyup', function() {
    if (!this.value) {
      $('#organization_id').val('');
    }
  });

  /**
   * Pesquisa por organizações (autocomplete)
   */
  $('#organization_search').autocomplete({
    serviceUrl: '/organization',
    params: {
      limit: 5
    },
    ajaxSettings: {
      dataType: 'json'
    },
    onSelect: function(suggestion) {
      $('#organization_id').val(suggestion.id);
    },
    transformResult: function(response) {
      response = (typeof response === 'string') ? $.parseJSON(response) : response;
      return {
        suggestions: $.map(response, function(e) {
          return {id: e.id, value: e.name + ' (' + e.phone + ')'};
        })
      };
    }
  });

  /**
   * Inicializa o material design
   */
  $.material.init();

})(jQuery);
