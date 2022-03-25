(function($){
    "user strict";

    $( window ).on( 'elementor:init', function() {
        var CMSIconsItemView = elementor.modules.controls.BaseData.extend({
            wrapper: null,
            items: null,
            iconpicker_els: null,
            url_els: null,
            add_btn: null,
            delete_btn: null,
            template: null,
            onReady: function () {
                var self = this;
                this.wrapper = $(this.el);
                this.items = this.wrapper.find(".etc-group-item");
                this.add_btn = this.wrapper.find(".etc-group-add");
                this.template = this.wrapper.find(".etc-template").val();

                self.setupIconPicker();
                self.setupUrlInput();
                self.setupDeleteBtn();
                this.add_btn.on("click", function(){
                    var new_item = $(self.template);
                    self.wrapper.find(".etc-group").append(new_item);
                    setTimeout(function(){
                        self.setupIconPicker();
                        self.setupUrlInput();
                        self.setupDeleteBtn();
                        self.items = self.wrapper.find(".etc-group-item");
                    }, 300);
                });
            },

            setupIconPicker: function () {
                var self = this;
                self.iconpicker_els = self.wrapper.find(".etc-iconpicker");
                self.iconpicker_els.fontIconPicker();
                self.iconpicker_els.on("change", function(e){
                    e.preventDefault();
                    self.saveValue();
                });
            },

            setupUrlInput: function () {
                var self = this;
                self.url_els = self.wrapper.find(".etc-url-input");
                self.url_els.on("keyup", function(e){
                    e.preventDefault();
                    self.saveValue();
                });
            },

            setupDeleteBtn: function () {
                var self = this;
                self.delete_btn = self.wrapper.find(".etc-group-delete");
                self.delete_btn.on("click", function(e){
                    e.preventDefault();
                    $(this).parent().remove();
                    self.items = self.wrapper.find(".etc-group-item");
                    self.saveValue();
                });
            },

            saveValue: function () {
                var values = [];
                $.each(this.items, function(index, item){
                    var item_val = {};
                    item_val.icon = $(item).find(".etc-iconpicker").val();
                    item_val.url = $(item).find(".etc-url-input").val();
                    values.push(item_val);
                });
                this.setValue(JSON.stringify(values));
            },

            onBeforeDestroy: function () {
                this.saveValue();
            }
        });

        elementor.addControlView('cms_icons', CMSIconsItemView);
    } );
}(jQuery));