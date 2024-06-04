const toggler = document.querySelector(".toggle");
const navLinksContainer = document.querySelector(".navlinks-container");

const toggleNav = e => {
  // Animation du bouton
  toggler.classList.toggle("open");

  const ariaToggle =
    toggler.getAttribute("aria-expanded") === "true" ? "false" : "true";
  toggler.setAttribute("aria-expanded", ariaToggle);

  // Slide de la navigation
  navLinksContainer.classList.toggle("open");
};

toggler.addEventListener("click", toggleNav);


new ResizeObserver(entries => {
  if (entries[0].contentRect.width <= 768){
    navLinksContainer.style.transition = "transform 0.4s ease-out";
  } else {
    navLinksContainer.style.transition = "none";
  }
}).observe(document.body)



let menuToggle =document.querySelector(".toggle");
  menuToggle.onclick=function(){
  menuToggle.classList.toggle('active');
}

  (function () {
    var expand;
    expand = function () {
      var $input, $search;
      $search = $('.search');
      $input = $('.input');
      if ($search.hasClass('close')) {
        $search.removeClass('close');
        $input.removeClass('square');
      } else {
        $search.addClass('close');
        $input.addClass('square');
      }
      if ($search.hasClass('close')) {
        $input.focus();
      } else {
        $input.blur();
      }
    };

  }
)
    //     $(function () {
//       var $accordion, $wideScreen;
//       $accordion = $('#accordion').children('li');
//       $wideScreen = $(window).width() > 767;
//       if ($wideScreen) {
//         $accordion.on('mouseenter click', function (e) {
//           var $this;
//           e.stopPropagation();
//           $this = $(this);
//           if ($this.hasClass('out')) {
//             $this.addClass('out');
//           } else {
//             $this.addClass('out');
//             $this.siblings().removeClass('out');
//           }
//         });
//       } else {
//         $accordion.on('touchstart touchend', function (e) {
//           var $this;
//           e.stopPropagation();
//           $this = $(this);
//           if ($this.hasClass('out')) {
//             $this.addClass('out');
//           } else {
//             $this.addClass('out');
//             $this.siblings().removeClass('out');
//           }
//         });
//       }
//     });

//     $(function () {
//       var $button, clickOrTouch;
//       clickOrTouch = 'click touchstart';
//       $button = $('#search-button');
//       $button.on(clickOrTouch, expand);
//     });
//     $(function () {
//       var $box;
//       $box = $('.sm-box');
//       $box.on('click', function (e) {
//         e.preventDefault();
//         var $this;
//         $this = $(this);
//         if ($this.hasClass('active')) {
//           $this.removeClass('active');
//         } else {
//           $this.addClass('active');
//         }
//       });
//     });
//   }.call(this));

// $("select").each(function () {
//   var $this = $(this),
//     $options = $(this).children("option").length;

//   $this.addClass("select-hidden");
//   $this.wrap("<div class='select'></div>");
//   $this.after("<div class='select-styled'></div>");

//   var $styledSelect = $this.next("div.select-styled");
//   $styledSelect.text($this.children("option").eq(0).text());

//   var $list = $("<ul />", {
//     "class": "select-options"
//   }).insertAfter($styledSelect);

//   for (var i = 0; i < $options; i++) {
//     $("<li />", {
//       text: $this.children("option").eq(i).text(),
//       rel: $this.children("option").eq(i).val()
//     }).appendTo($list);
//   }

//   var $listItems = $list.children("li");

//   $styledSelect.on("click", function (e) {
//     e.stopPropagation();
//     $("div.select-styled.active").each(function () {
//       $(this).removeClass("active").next("ul.select-options").hide();
//     });

//     $(this).toggleClass("active").next("ul.select-options").toggle();
//   });

//   $listItems.on("click", function (e) {
//     e.stopPropagation();
//     $styledSelect.text($(this).text()).removeClass("active");
//     $this.val($(this).attr("rel"));
//     $list.hide();
//   });

//   $(document).on("click", function () {
//     $styledSelect.removeClass("active");
//     $list.hide();
//   });

//   $(".select-sibling").next(".select-styled").css({
//     "border-top": "0px"
//   });
// });

// (function () {
//   var $addItem = $("#add-item");
//   var $badge = $(".badge");
//   var $count = 1;

//   $addItem.on("click", function (e) {
//     e.preventDefault();
//     $badge.html($count++);
//   });
// }.call(this));