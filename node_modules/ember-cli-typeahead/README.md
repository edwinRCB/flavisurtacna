#Ember CLI Typeahead

## Description
This component uses twitter's typeahead (for now) with an ember back-end.

## Installation
npm install ember-cli-typeahead --save-dev
ember g ember-cli-typeahead

## Basic Usage

  {{type-ahead class="typeahead" placeholder="Search countries"
             name="countries" highlight=true content=content targetAction="typeAheadTargetAction"}}
             
## Properties

* content: The data used in the lookup.
* targetAction: This is the action that will be called on events focusIn, focusOut, keyUp and keyDown. The action 
will pass in a corresponding value to let the controller know which event triggered it - i.e "focus-in", "focus-out", 
"key-up" or "key-down".

## Demo
Check out the demo on [github pages](http://gevious.github.io/ember-typeahead/ "Ember-typeahead Demo").
Alternatively you can clone this repo and run the app

    sudo npm install -g ember-cli
    git clone git@github.com:gevious/ember-typeahead
    cd ember-typeahead
    npm install; bower install
    ember serve

## Options
The typeahead box is a `TextField` and so has all those options available. In
addition, it also has the typeahead.js options available. You can find
those options [in their api](https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md#api "Twitter typeahead.js API")
under the _Options_ sub-heading.
