<template>
    <div class="mb-1">
        <b-nav tabs id="nav" :class="'grievances-tabs'">
            <b-nav-item :href="route('dashboard.information-requests.index')" :class="'inertia-link'" :active="route().current('dashboard.information-requests.index')">
                All <b-badge variant="secondary">{{ data.stats && data.stats.all_requests ? data.stats.all_requests : '0' }}</b-badge>
            </b-nav-item>
            <b-nav-item :href="route('dashboard.information-requests.new')" :class="'inertia-link'" :active="route().current('dashboard.information-requests.new')">
                NEW <b-badge variant="primary">{{ data.stats && data.stats.new ? data.stats.new : '0' }}</b-badge>
            </b-nav-item>
            <b-nav-item :href="route('dashboard.information-requests.pending')" :class="'inertia-link'" :active="route().current('dashboard.information-requests.pending')">
                PENDING <b-badge variant="secondary">{{ data.stats && data.stats.pending ? data.stats.pending : '0' }}</b-badge>
            </b-nav-item>
            <b-nav-item :href="route('dashboard.information-requests.awaitingresponse')" :class="'inertia-link'" :active="route().current('dashboard.information-requests.awaitingresponse')">
                AWAITING RESPONSE <b-badge variant="secondary">{{ data.stats && data.stats.awaitingresponse ? data.stats.awaitingresponse : '0' }}</b-badge>
            </b-nav-item>
            <b-nav-item :href="route('dashboard.information-requests.awaitingfeedback')" :class="'inertia-link'" :active="route().current('dashboard.information-requests.awaitingfeedback')">
                AWAITING FEEDBACK <b-badge variant="secondary">{{ data.stats && data.stats.awaitingfeedback ? data.stats.awaitingfeedback : '0' }}</b-badge>
            </b-nav-item>
            <b-nav-item :href="route('dashboard.information-requests.moreinformation')" :class="'inertia-link'" :active="route().current('dashboard.information-requests.moreinformation')">
                MORE INFORMATION <b-badge variant="secondary">{{ data.stats && data.stats.moreinformation ? data.stats.moreinformation : '0' }}</b-badge>
            </b-nav-item>
            <b-nav-item :href="route('dashboard.information-requests.completed')" :class="'inertia-link'" :active="route().current('dashboard.information-requests.completed')">
                COMPLETED <b-badge variant="secondary">{{ data.stats && data.stats.completed ? data.stats.completed : '0' }}</b-badge>
            </b-nav-item>
        </b-nav>
    </div>
</template>

<script>
    export default {
        props: [
            'data',
        ],
        data() {
            return {
            }
        },

        // mounted() {
        //     // Using "css-element-queries" plugin to manage div size changes
        //     new ResizeSensor(jQuery('#nav'), function(){ 
        //         navigationResize();
        //     });
        // }
    }
    // function navigationResize() {  
    //     $('#nav li.more').before($('#overflow > li'));
    
    //     var $navItemMore = $('#nav > li.more'),
    //         $navItems = $('#nav > li:not(.more)'),
    //         // navItemMoreWidth = navItemWidth = $navItemMore.width(),
    //         navItemWidth = $navItemMore.width(),
    //         windowWidth = $('header .container-fluid').width() + 0,
    //         navItemMoreLeft, offset, navOverflowWidth;
    
    //     $navItems.each(function() {
    //         navItemWidth += $(this).width();
    //     });
    
    //     navItemWidth > windowWidth ? $navItemMore.show() : $navItemMore.hide();
        
    //     while (navItemWidth > windowWidth) {
    //         navItemWidth -= $navItems.last().width();
    //         $navItems.last().prependTo('#overflow');
    //         $navItems.splice(-1,1);
    //     }
    // }
</script>

