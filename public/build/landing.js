(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["landing"],{

/***/ "./assets/public/js/landing/landing.js":
/*!*********************************************!*\
  !*** ./assets/public/js/landing/landing.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {$(document).ready(function () {
  if (!$('#messagesdisplay').length) {
    return;
  }

  Home.updateMessages();
  Home.updateThreads();
  $('a[data-toggle="tab"]').on('show.bs.tab', Home.onTabChange);
  $('#all, #unread').change(function () {
    setTimeout(Home.updateMessages, 500);
  });
  $('#groupsButton, #forumButton, #followingButton').change(function () {
    setTimeout(Home.updateThreads, 500);
  });
  $('.hosting').click(Home.setHostingStatus);
});
var Home = {
  onTabChange: function onTabChange(e) {
    switch ($(e.target).attr('aria-controls')) {
      case 'messages':
        return Home.updateMessages();

      case 'notifications':
        return Home.updateNotifications();

      case 'threads':
        return Home.updateThreads();

      case 'activities':
        return Home.updateActivities();
    }
  },
  updateMessages: function updateMessages() {
    var all = $('#all').hasClass('active') ? 1 : 0;
    var unread = $('#unread').hasClass('active') ? 1 : 0;
    $.ajax({
      type: 'GET',
      url: '/widget/messages',
      data: {
        all: all,
        unread: unread
      },
      success: function success(messages) {
        $('#messagesdisplay').replaceWith(messages);
      }
    });
  },
  updateNotifications: function updateNotifications() {
    $.ajax({
      type: 'GET',
      url: '/widget/notifications',
      success: function success(notifications) {
        $('#notificationsdisplay').replaceWith(notifications); // Set click event

        $('.notify').click(function () {
          var that = $(this);
          var id = $(this).attr('id');
          $.ajax({
            type: 'GET',
            url: '/notify/' + id.replace('notify-', '') + '/check',
            success: function success() {
              // update the notifications
              Home.updateNotifications();
            }
          });
        });
      }
    });
  },
  updateThreads: function updateThreads() {
    // Get parameters
    var groups = $('#groupsButton').hasClass('active') ? 1 : 0;
    var forum = $('#forumButton').hasClass('active') ? 1 : 0;
    var following = $('#following').hasClass('active') ? 1 : 0;
    $.ajax({
      type: 'GET',
      url: '/widget/threads',
      data: {
        groups: groups,
        forum: forum,
        following: following
      },
      success: function success(threads) {
        $('#threadsdisplay').replaceWith(threads);
      }
    });
  },
  updateActivities: function updateActivities() {
    // Get parameters
    $.ajax({
      type: 'GET',
      url: '/widget/activities',
      data: {},
      success: function success(activities) {
        $('#activitiesdisplay').replaceWith(activities);
      }
    });
  },
  setHostingStatus: function setHostingStatus(e) {
    e.preventDefault(); // Get parameters

    var accommodation = this.id;
    $.ajax({
      type: 'POST',
      url: '/widget/accommodation',
      data: {
        accommodation: accommodation
      },
      dataType: 'json',
      success: function success(data) {
        $('#welcomeavatar').replaceWith(data.profilePictureWithAccommodation);
        $('#accommodation').replaceWith(data.accommodationHtml);
        $('.hosting').click(Home.setHostingStatus);
      }
    });
  }
};
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js-exposed")))

/***/ })

},[["./assets/public/js/landing/landing.js","runtime","bewelcome"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvcHVibGljL2pzL2xhbmRpbmcvbGFuZGluZy5qcyJdLCJuYW1lcyI6WyIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsImxlbmd0aCIsIkhvbWUiLCJ1cGRhdGVNZXNzYWdlcyIsInVwZGF0ZVRocmVhZHMiLCJvbiIsIm9uVGFiQ2hhbmdlIiwiY2hhbmdlIiwic2V0VGltZW91dCIsImNsaWNrIiwic2V0SG9zdGluZ1N0YXR1cyIsImUiLCJ0YXJnZXQiLCJhdHRyIiwidXBkYXRlTm90aWZpY2F0aW9ucyIsInVwZGF0ZUFjdGl2aXRpZXMiLCJhbGwiLCJoYXNDbGFzcyIsInVucmVhZCIsImFqYXgiLCJ0eXBlIiwidXJsIiwiZGF0YSIsInN1Y2Nlc3MiLCJtZXNzYWdlcyIsInJlcGxhY2VXaXRoIiwibm90aWZpY2F0aW9ucyIsInRoYXQiLCJpZCIsInJlcGxhY2UiLCJncm91cHMiLCJmb3J1bSIsImZvbGxvd2luZyIsInRocmVhZHMiLCJhY3Rpdml0aWVzIiwicHJldmVudERlZmF1bHQiLCJhY2NvbW1vZGF0aW9uIiwiZGF0YVR5cGUiLCJwcm9maWxlUGljdHVyZVdpdGhBY2NvbW1vZGF0aW9uIiwiYWNjb21tb2RhdGlvbkh0bWwiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7OztBQUFBQSwwQ0FBQyxDQUFDQyxRQUFELENBQUQsQ0FBWUMsS0FBWixDQUFrQixZQUFXO0FBQ3pCLE1BQUksQ0FBQ0YsQ0FBQyxDQUFDLGtCQUFELENBQUQsQ0FBc0JHLE1BQTNCLEVBQW1DO0FBQy9CO0FBQ0g7O0FBRURDLE1BQUksQ0FBQ0MsY0FBTDtBQUNBRCxNQUFJLENBQUNFLGFBQUw7QUFFQU4sR0FBQyxDQUFDLHNCQUFELENBQUQsQ0FBMEJPLEVBQTFCLENBQTZCLGFBQTdCLEVBQTRDSCxJQUFJLENBQUNJLFdBQWpEO0FBRUFSLEdBQUMsQ0FBQyxlQUFELENBQUQsQ0FBbUJTLE1BQW5CLENBQTBCLFlBQVc7QUFDakNDLGNBQVUsQ0FBQ04sSUFBSSxDQUFD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QkFBVUQsSUFBVixFQUFnQjtBQUNyQnhCLFNBQUMsQ0FBQyxnQkFBRCxDQUFELENBQW9CMkIsV0FBcEIsQ0FBZ0NILElBQUksQ0FBQ2dCLCtCQUFyQztBQUNBeEMsU0FBQyxDQUFDLGdCQUFELENBQUQsQ0FBb0IyQixXQUFwQixDQUFnQ0gsSUFBSSxDQUFDaUIsaUJBQXJDO0FBQ0F6QyxTQUFDLENBQUMsVUFBRCxDQUFELENBQWNXLEtBQWQsQ0FBb0JQLElBQUksQ0FBQ1EsZ0JBQXpCO0FBQ0g7QUFYRSxLQUFQO0FBYUg7QUF2R00sQ0FBWCxDIiwiZmlsZSI6ImxhbmRpbmcuanMiLCJzb3VyY2VzQ29udGVudCI6WyIkKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcbiAgICBpZiAoISQoJyNtZXNzYWdlc2Rpc3BsYXknKS5sZW5ndGgpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIEhvbWUudXBkYXRlTWVzc2FnZXMoKTtcbiAgICBIb21lLnVwZGF0ZVRocmVhZHMoKTtcblxuICAgICQoJ2FbZGF0YS10b2dnbGU9XCJ0YWJcIl0nKS5vbignc2hvdy5icy50YWInLCBIb21lLm9uVGFiQ2hhbmdlKTtcblxuICAgICQoJyNhbGwsICN1bnJlYWQnKS5jaGFuZ2UoZnVuY3Rpb24oKSB7XG4gICAgICAgIHNldFRpbWVvdXQoSG9tZS51cGRhdGVNZXNzYWdlcywgNTAwKTtcbiAgICB9KTtcblxuICAgICQoJyNncm91cHNCdXR0b24sICNmb3J1bUJ1dHRvbiwgI2ZvbGxvd2luZ0J1dHRvbicpLmNoYW5nZShmdW5jdGlvbigpIHtcbiAgICAgICAgc2V0VGltZW91dChIb21lLnVwZGF0ZVRocmVhZHMsIDUwMCk7XG4gICAgfSk7XG5cbiAgICAkKCcuaG9zdGluZycpLmNsaWNrKEhvbWUuc2V0SG9zdGluZ1N0YXR1cyk7XG59KTtcblxudmFyIEhvbWUgPSB7XG4gICAgb25UYWJDaGFuZ2U6IGZ1bmN0aW9uIChlKSB7XG4gICAgICAgIHN3aXRjaCgkKGUudGFyZ2V0KS5hdHRyKCdhcmlhLWNvbnRyb2xzJykpIHtcbiAgICAgICAgICAgIGNhc2UgJ21lc3NhZ2VzJzpcbiAgICAgICAgICAgICAgICByZXR1cm4gSG9tZS51cGRhdGVNZXNzYWdlcygpO1xuXG4gICAgICAgICAgICBjYXNlICdub3RpZmljYXRpb25zJzpcbiAgICAgICAgICAgICAgICByZXR1cm4gSG9tZS51cGRhdGVOb3RpZmljYXRpb25zKCk7XG5cbiAgICAgICAgICAgIGNhc2UgJ3RocmVhZHMnOlxuICAgICAgICAgICAgICAgIHJldHVybiBIb21lLnVwZGF0ZVRocmVhZHMoKTtcblxuICAgICAgICAgICAgY2FzZSAnYWN0aXZpdGllcyc6XG4gICAgICAgICAgICAgICAgcmV0dXJuIEhvbWUudXBkYXRlQWN0aXZpdGllcygpO1xuICAgICAgICB9XG4gICAgfSxcbiAgICB1cGRhdGVNZXNzYWdlczogZnVuY3Rpb24gKCkge1xuICAgICAgICB2YXIgYWxsID0gJCgnI2FsbCcpLmhhc0NsYXNzKCdhY3RpdmUnKSA/IDEgOiAwO1xuICAgICAgICB2YXIgdW5yZWFkID0gJCgnI3VucmVhZCcpLmhhc0NsYXNzKCdhY3RpdmUnKSA/IDEgOiAwO1xuXG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB0eXBlOiAnR0VUJyxcbiAgICAgICAgICAgIHVybDogJy93aWRnZXQvbWVzc2FnZXMnLFxuICAgICAgICAgICAgZGF0YToge1xuICAgICAgICAgICAgICAgIGFsbDogYWxsLFxuICAgICAgICAgICAgICAgIHVucmVhZDogdW5yZWFkXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24obWVzc2FnZXMpIHtcbiAgICAgICAgICAgICAgICAkKCcjbWVzc2FnZXNkaXNwbGF5JykucmVwbGFjZVdpdGgobWVzc2FnZXMpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICB9LFxuICAgIHVwZGF0ZU5vdGlmaWNhdGlvbnM6IGZ1bmN0aW9uKCkge1xuICAgICAgICAkLmFqYXgoe1xuICAgICAgICAgICAgdHlwZTogJ0dFVCcsXG4gICAgICAgICAgICB1cmw6ICcvd2lkZ2V0L25vdGlmaWNhdGlvbnMnLFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKG5vdGlmaWNhdGlvbnMpIHtcbiAgICAgICAgICAgICAgICAkKCcjbm90aWZpY2F0aW9uc2Rpc3BsYXknKS5yZXBsYWNlV2l0aChub3RpZmljYXRpb25zKTtcblxuICAgICAgICAgICAgICAgIC8vIFNldCBjbGljayBldmVudFxuICAgICAgICAgICAgICAgICQoJy5ub3RpZnknKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgIHZhciB0aGF0ID0gJCh0aGlzKTtcbiAgICAgICAgICAgICAgICAgICAgdmFyIGlkID0gJCh0aGlzKS5hdHRyKCdpZCcpO1xuXG4gICAgICAgICAgICAgICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICAgICAgICAgICAgICB0eXBlOiAnR0VUJyxcbiAgICAgICAgICAgICAgICAgICAgICAgIHVybDogJy9ub3RpZnkvJyArIGlkLnJlcGxhY2UoJ25vdGlmeS0nLCAnJykgKyAnL2NoZWNrJyxcbiAgICAgICAgICAgICAgICAgICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIC8vIHVwZGF0ZSB0aGUgbm90aWZpY2F0aW9uc1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIEhvbWUudXBkYXRlTm90aWZpY2F0aW9ucygpO1xuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfSxcbiAgICB1cGRhdGVUaHJlYWRzOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgIC8vIEdldCBwYXJhbWV0ZXJzXG4gICAgICAgIHZhciBncm91cHMgPSAkKCcjZ3JvdXBzQnV0dG9uJykuaGFzQ2xhc3MoJ2FjdGl2ZScpID8gMSA6IDA7XG4gICAgICAgIHZhciBmb3J1bSA9ICQoJyNmb3J1bUJ1dHRvbicpLmhhc0NsYXNzKCdhY3RpdmUnKSA/IDEgOiAwO1xuICAgICAgICB2YXIgZm9sbG93aW5nID0gJCgnI2ZvbGxvd2luZycpLmhhc0NsYXNzKCdhY3RpdmUnKSA/IDEgOiAwO1xuXG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB0eXBlOiAnR0VUJyxcbiAgICAgICAgICAgIHVybDogJy93aWRnZXQvdGhyZWFkcycsXG4gICAgICAgICAgICBkYXRhOiB7XG4gICAgICAgICAgICAgICAgZ3JvdXBzOiBncm91cHMsXG4gICAgICAgICAgICAgICAgZm9ydW06IGZvcnVtLFxuICAgICAgICAgICAgICAgIGZvbGxvd2luZzogZm9sbG93aW5nXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKHRocmVhZHMpIHtcbiAgICAgICAgICAgICAgICAkKCcjdGhyZWFkc2Rpc3BsYXknKS5yZXBsYWNlV2l0aCh0aHJlYWRzKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfSxcbiAgICB1cGRhdGVBY3Rpdml0aWVzOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgIC8vIEdldCBwYXJhbWV0ZXJzXG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB0eXBlOiAnR0VUJyxcbiAgICAgICAgICAgIHVybDogJy93aWRnZXQvYWN0aXZpdGllcycsXG4gICAgICAgICAgICBkYXRhOiB7fSxcbiAgICAgICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uIChhY3Rpdml0aWVzKSB7XG4gICAgICAgICAgICAgICAgJCgnI2FjdGl2aXRpZXNkaXNwbGF5JykucmVwbGFjZVdpdGgoYWN0aXZpdGllcyk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH0sXG4gICAgc2V0SG9zdGluZ1N0YXR1czogZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAvLyBHZXQgcGFyYW1ldGVyc1xuICAgICAgICB2YXIgYWNjb21tb2RhdGlvbiA9IHRoaXMuaWQ7XG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB0eXBlOiAnUE9TVCcsXG4gICAgICAgICAgICB1cmw6ICcvd2lkZ2V0L2FjY29tbW9kYXRpb24nLFxuICAgICAgICAgICAgZGF0YToge1xuICAgICAgICAgICAgICAgIGFjY29tbW9kYXRpb246IGFjY29tbW9kYXRpb25cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICAgICAgICAgICAkKCcjd2VsY29tZWF2YXRhcicpLnJlcGxhY2VXaXRoKGRhdGEucHJvZmlsZVBpY3R1cmVXaXRoQWNjb21tb2RhdGlvbik7XG4gICAgICAgICAgICAgICAgJCgnI2FjY29tbW9kYXRpb24nKS5yZXBsYWNlV2l0aChkYXRhLmFjY29tbW9kYXRpb25IdG1sKTtcbiAgICAgICAgICAgICAgICAkKCcuaG9zdGluZycpLmNsaWNrKEhvbWUuc2V0SG9zdGluZ1N0YXR1cyk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH1cbn07XG4iXSwic291cmNlUm9vdCI6IiJ9