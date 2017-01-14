var ViewManager = {

    loadTemplate: function(templateUrl) {
        var template = "";
        $.ajax({
            url: templateUrl,
            async: false,
            dataType: "html",
            success: function(data) {
                template = data;
            }
        });
        return template;
    },

    render: function(data, component, templateName) {
        var template = this.loadTemplate("templates/" + templateName + ".mst.html");
        if (template != null) {
            html = Mustache.render(template, data);
        }

        $(component).empty();
        $(component).html(html);
    }

}