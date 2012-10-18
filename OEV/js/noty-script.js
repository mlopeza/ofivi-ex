/* 
 * Authors: Nedim Arabacı (http://ned.im), Muhittin Özer (http://muhittinozer.com) 
*/

var alert_note = 'Best check yo self, you\'re not looking too good.';
var error_note = 'Change a few things up and try submitting again.';
var success_note = 'You successfully read this important alert message.';
var information_note = 'This alert needs your attention, but it\'s not super important.';
var note = 'Do you want to continue?';

function getCode() {
	var optionsArray = $('#noty_creator').serializeArray();
	var options = {};
	var objects = ['onShow', 'onClose', 'animateOpen', 'animateClose', 'speed', 'timeout'];
	
	$.each(optionsArray, function(index, field) { 
		if (jQuery.inArray(field.name, objects) > -1) {
			options[field.name] = eval("(" + field.value + ')');
		} else {
			if (field.value == 'false') {
				options[field.name] = false;
			} else if (field.value == 'true') {
				options[field.name] = true;
			} else {
				options[field.name] = field.value;
			}
		}
		if ($.noty.defaultOptions.theme != 'noty_theme_default')
			options['theme'] = $.noty.defaultOptions.theme;
	});
	return options;
}

function commit_history() {
	$.getJSON('http://github.com/api/v2/json/commits/list/needim/noty/master?callback=?', function(json) {
		$('#commit-history-json tr').remove();
		$.each(json.commits, function(i, commit) {
			var $col = $('<tr />');
			var $committer = $('<td />').html(commit.committer.name);
			var $link = $('<a />').attr('href', 'https://github.com/needim/noty/commit/' + commit.id).html(commit.message);
			var $url = $('<td />').append($link);
			var $date = $('<td />').html($.format.date(commit.committed_date, "dd.MM.yy hh:mm a"));
			
			$col.append($committer);
			$col.append($url);
			$col.append($date);
			
			$('#commit-history-json').append($col);
		});
	});
}

$(document).ready(function() {
	
	$("select#theme_switcher").val('noty_theme_default');
	$("select#theme_switcher").change(function() {
		$('.noty_theme_default').removeClass('noty_theme_default').addClass($(this).val());
		$('.noty_theme_mitgux').removeClass('noty_theme_mitgux').addClass($(this).val());
		$('.noty_theme_twitter').removeClass('noty_theme_twitter').addClass($(this).val());
		$('.noty_theme_facebook').removeClass('noty_theme_facebook').addClass($(this).val());
		$.noty.defaultOptions.theme = $(this).val();
	});
	
	$('.api-func').click(function(e) {
		try {
			var func = $(this).attr('title');
			eval(func);
		} catch (e) {
			// TODO: handle exception
		}
		e.preventDefault();
	});
	
	$(".cb-enable").live('click', function(){
		var parent = $(this).parents('.switch');
		$('.cb-disable',parent).removeClass('selected');
		$(this).addClass('selected');
		if ($(this).attr('title') == 'noty_theme_mitgux') {
			$.noty.defaultOptions.theme = 'noty_theme_mitgux';
		} else if ($(this).attr('title')) {
			$('#'+$(this).attr('title')).val('true');
		} else {
			$.noty.defaultOptions.modal = true;
		}
	});
	
	$(".cb-disable").live('click', function(){
		var parent = $(this).parents('.switch');
		$('.cb-enable',parent).removeClass('selected');
		$(this).addClass('selected');
		if ($(this).attr('title') == 'noty_theme_mitgux') {
			$.noty.defaultOptions.theme = 'noty_theme_default';
		} else if ($(this).attr('title')) {
			$('#'+$(this).attr('title')).val('false');
		} else {
			$.noty.defaultOptions.modal = false;
		}
	});
	
	$('a.show-div').click(function() {
		var $button = $(this); 
		$('div.content').load($button.attr('href').replace('#', '')+'.html', function() {
			Rainbow.color();
			$('ul a.active').removeClass('active');
			$button.addClass('active');
			if ($button.attr('href') == '#commit-history') commit_history();
		});
	});
	
	if (location.hash) {
		$('a[href='+location.hash+']').trigger('click');
	} else {
		$('a[href=#welcome]').trigger('click');
	}
	
	$('#getCode').live('click', function() {
		var source = getCode();
		$('textarea#getCodeResult').html('noty('+ JSON.stringify(source) +');').slideDown();
	});
	
	$('#runIt').live('click', function() {
		var source = getCode();
		noty(source);
	});
	
	// EX 1 ======================	

	// ex1 - error
	$('.ex1.error').click(function() {
		noty({text: error_note, type: 'error'});
		return false;
	});
	
	// ex1 - success
	$('.ex1.success').click(function() {
		noty({text: "El usuario ha sido aceptado sin problemas.", type: 'success'});
		return false;
	});

});
