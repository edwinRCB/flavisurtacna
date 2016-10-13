module.exports = {
  name: 'ember-cli-typeahead',
  included: function(app) {
    this._super.included(app);

    app.import('bower_components/typeahead.js/dist/typeahead.jquery.js');
    app.import('vendor/typeahead.css');
  }
};
