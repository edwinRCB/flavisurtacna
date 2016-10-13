import startApp from '../helpers/start-app';
import { test } from 'ember-qunit';
import Em from 'ember';
var App;

module('Local Content', {
  setup: function() {
    App = startApp();
  },
  teardown: function() {
    Em.run(App, App.destroy);
  }
});

test("Search works", function() {
  expect(1);
  visit('/');
  andThen(function() {
    equal(find("input").length, 2);  // for some reason typeahead add input box
  });
});
