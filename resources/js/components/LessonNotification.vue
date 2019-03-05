<template>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fa fa-globe"></i>Notification
            <span class="badge badge-danger">{{lessons.length}}</span>
            <span class="caret"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

            <a href="#" class="dropdown-item" v-for="lesson in lessons">
                {{ lesson.data }}
            </a>

            <!--<div role="separator" class="dropdown-divider" v-if="lessons.length==0">-->
                <a href="#" class="dropdown-item" v-if="lessons.length==0">
                    No Notification
                </a>
            </div>


        </div>
    </li>
</template>

<script>
    export default{
        props:['lessons'],
    };
</script>