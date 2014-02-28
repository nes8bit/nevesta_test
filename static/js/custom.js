var TESTCASE = {};

TESTCASE.tags = {
    $select: null,
    $addContainer: null,
    $excludeContainer: null,
    init: function($select, $addContainer, $excludeContainer) {
        this.$select            = $select;
        this.$addContainer      = $addContainer;
        this.$excludeContainer  = $excludeContainer;

        this.bindEvents(this);
    },

    bindEvents: function(tags) {
        $('.b-tags').on('click', '.b-tag__remove', function(e) {
            e.preventDefault();
            $(this).parent().remove();
        });

        $('.b-tags__add').on('click', function(e) {
            e.preventDefault();
            tags.addTag();
        });

        $('.b-tags__exclude').on('click', function(e) {
            e.preventDefault();
            tags.excludeTag();
        });
    },

    getSelectChoice: function () {
        return {
            text: this.$select.children(':selected').text(),
            value: this.$select.val()
        };
    },
    checkIfExists: function(data) {
        return Boolean($('.b-tag input[value='+data.value+']').length);
    },

    getTemplate: function(action, data) {
        return     '<div class="b-tag b-tag__' + action + '">' +
            '<p>' + data.text + '</p>' +
            '<input type="hidden" name="' +action + '_tags[]" value="' + data.value + '" >' +
            '<a href="#" class="b-tag__remove">X</a>' +
            '</div>'
    },

    addTag: function() {
        data = this.getSelectChoice();
        if ( this.checkIfExists(data) ) {
            return false;
        }
        template = this.getTemplate('add', data);

        this.$addContainer.append(template);
    },

    excludeTag: function() {
        data = this.getSelectChoice();
        if ( this.checkIfExists(data) ) {
            return false;
        }
        template = this.getTemplate('exclude', data);

        this.$excludeContainer.append(template);
    }
};
