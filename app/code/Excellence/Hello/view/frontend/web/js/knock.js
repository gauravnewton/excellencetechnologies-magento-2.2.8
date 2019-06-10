"use strict";
define(['uiComponent'], function(Component) {
  
        return Component.extend({
            initialize: function () {
                this._super();
                this.hello = 'Hello World';
            }
        });
});