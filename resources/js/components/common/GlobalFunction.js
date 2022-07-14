/* jshint node: true */
const Vue = window.vue;

let getImgUrl = (pic) => {
    // return require('../Chat' + pic);
    return '/../../../frontend/images/avatars/' + pic;
};
Vue.use(getImgUrl); //register
