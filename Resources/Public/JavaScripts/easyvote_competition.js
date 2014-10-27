$(function() {
	var $body = $('body');

	Easyvote.bindToolTips();

	$('textarea[maxlength]').maxlength({
		threshold: 140
	});

	var $listParticipationsContainer = $('.listParticipationsContainer');
	if ($listParticipationsContainer.length && typeof(getParticipationsUri) === 'string') {
		EasyvoteCompetition.loadParticipations(getParticipationsUri).done(function(data) {
			$listParticipationsContainer.html(data);
			if (typeof(singleParticipationUid) === 'string') {
				var $currentParticipations = $(".participation-" + singleParticipationUid);
				$currentParticipations.addClass('participation-single-selected');
				if (typeof(openSharer) === 'string') {
					if (openSharer === '1') {
						$currentParticipations.first().find('.shareTrigger').trigger('click');
					}
				}
			}
			EasyvoteCompetition.bindInfiniteScrolling();
			Easyvote.bindToolTips();
		});
	}

	$body.on('click', '.voteForParticipation', function(e) {
		e.preventDefault();
		$('#showSingleParticipationContainer').hide().remove();
		participationUid = $(e.target).closest('a').attr('data-participation');
		if (typeof(voteForParticipationUri) === 'string') {
			$.ajax({
				url: voteForParticipationUri,
				type: 'POST',
				data: { 'tx_easyvotecompetition_competitiondetail[participation]' : participationUid},
				success: function() {
					EasyvoteCompetition.loadParticipations(getParticipationsUri).done(function(data) {
						$listParticipationsContainer.html(data);
						EasyvoteCompetition.bindInfiniteScrolling();
						Easyvote.bindToolTips();
					});
				}
			})
		}
	});

	$body.on('click', '.voteForParticipation-notAuthenticated', function(e) {
		e.preventDefault();
		$('.login-link').trigger('click');
	});

	$body.on('click', '.addParticipation-notAuthenticated', function(e) {
		e.preventDefault();
		$('.login-link').trigger('click');
	});

	$body.on('click', '.voteForParticipation-alreadyVoted', function(e) {
		e.preventDefault();
	});

	$body.on('click', '.share-popup', function(e) {
		e.preventDefault();
		var shareUrl = $(e.target).closest('a').attr('href');
		window.open(shareUrl, 'share', 'height=320, width=600, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');
	});

});

var EasyvoteCompetition = {
	loadParticipations: function(uri) {
		return $.ajax({
			url: uri
		});
	},
	/* Infinite scrolling for participations */
	bindInfiniteScrolling: function() {
		console.log('hier');
		$('.listParticipationsContainer').jscroll({
			autoTrigger: false,
			nextSelector: '.records-navigation a',
			contentSelector: '',
			loadingHtml: '<div class="records-loading">laden...</div>',
			refresh: true
		});

	}
}