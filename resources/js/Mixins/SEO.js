import Vue from 'vue'
// import moment from 'moment'

export default {

    metaInfo() {
        return {
            title: this.getTitle(),
            meta: [
                { name: 'application-name', content: this.$page.props.config.app.name },
                { name: 'description', content: this.$page.props.metatags.description }, // id to replace intead of create element
                // Twitter
                { name: 'twitter:title', content: 'Content Title' },
                // Google+ / Schema.org
                { itemprop: 'name', content: this.getTitle() },
                { itemprop: 'description', content: this.$page.props.metatags.description },
            ],
            link: [
                // { rel: 'canonical', href: 'http://example.com/#!/contact/', id: 'canonical' },
                // { rel: 'author', href: 'author', undo: false }, // undo property - not to remove the element
                // { rel: 'icon', href: './path/to/icon-16.png', sizes: '16x16', type: 'image/png' }, 
                // // with shorthand
                // { r: 'icon', h: 'path/to/icon-32.png', sz: '32x32', t: 'image/png' },
            ],
        }
    },
    methods: {
        getTitle() {
            if (this.$page.props.route.name == 'front') {
               return this.$page.props.app.name + ' | ' + this.$page.props.app.tagline 
            }

            if (this.$page.props.metatags.title == this.$page.props.app.name) {
                return this.pageTitle + ' | ' + this.$page.props.config.app.name
            }

            return this.$page.props.metatags.title
        },
    }
    // created() {
    //     console.log( this.$page.props.route.name )
    // },

}

