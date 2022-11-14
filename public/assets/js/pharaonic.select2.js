if (void 0 === Pharaonic) var Pharaonic = {};
var PharaonicSelect2 = {
    Select2: {
        init: function () {
            $('[data-pharaonic="select2"]:not("[data-select2-id]")').each(function () {
                Pharaonic.Select2.load($(this), $(this).is("[data-component-id]") ? $(this).data("component-id") : null);
            });
        },
        load: function (a, e) {
            if (e) {
                var t = {
                        multiple: $(a).is("[multiple]"),
                        tags: $(a).is("[data-tags]"),
                        placeholder: $(a).is("[data-placeholder]") ? $(a).data("placeholder") : "Select an option",
                        language: $(a).is("[data-language]") ? $(a).data("language") : "en",
                        dir: $(a).is("[data-dir]") ? $(a).data("dir") : "ltr",
                        dropdownParent: $(a).is("[data-parent]") ? $($(a).data("parent")) : null,
                        minimumResultsForSearch: $(a).is("[data-search-off]") ? -1 : 0,
                        allowClear: $(a).is("[data-allow-clear]") ? true : false,
                        width: $(a).is("[data-width]") ? $(a).data("width") : "style",
                    },
                    i = a[0].attributes,
                    n = i.getNamedItem("wire:model") || i.getNamedItem("wire:model.defer") || null;
                if ((delete i, (a = $(a).select2(t)), n)) {
                    var d = n.value,
                        l = n.name.search("defer") > 0;
                    a.on("change", function () {
                        console.log('Pharaonic.Select2.load', 'a', a, 'e', e, 'd', d, 'l', l);
                        Livewire.find(e).set(d, $(a).val(), l);
                    });
                }
            }
        },
    },
};
Object.assign(Pharaonic, PharaonicSelect2),
    $(document).ready(function () {
        Pharaonic.Select2.init();
    }),
    window.addEventListener("pharaonic.select2.init", (a) => {
        Pharaonic.Select2.init();
    }),
    window.addEventListener("pharaonic.select2.load", (a) => {
        Pharaonic.Select2.load($(a.detail.target), a.detail.component);
    });
