"use strict";
exports.__esModule = true;
exports.hello = void 0;
var world = 'world';
// @ts-ignore
function hello(world) {
    if (world === void 0) { world = world; }
    return "Hello ".concat(world, "! ");
}
exports.hello = hello;
