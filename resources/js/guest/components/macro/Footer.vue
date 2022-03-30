<template>
    <footer>
        <div class="link-cont">
            <div>
                <a  href="/"><img src="/img/deliveboo_logo.png" alt=""></a>
            </div>
        </div>
        <div class="scritta">
            <p>Powered With ❤ by Team 6</p>
        </div>
        <div class="links">
            <ul>
                <li v-for="link, i in socialLinks" :key="i">
                    <a :href="link.url">
                        <img :src="`/img/${link.img}`" :alt="link.alt">
                    </a>
                </li>
            </ul>
        </div>
    </footer>
</template>

<script>
export default {
    name: 'Footer',
    data(){
        return{
        socialLinks: [
            {
                img: 'facebook.png',
                url: '#',
                alt: 'Facebook'
            },
            {
                img: 'twitter.png',
                url: '#',
                alt: 'Twitter'
            },
            {
                img: 'youtube.png',
                url: '#',
                alt: 'YouTube'
            },
            {
                img: 'pinterest.png',
                url: '#',
                alt: 'Pinterest'
            },
            {
                img: 'periscope.png',
                url: '#',
                alt: 'Periscope'
            },
        ]
        }
    }
}
</script>

<style lang="scss" scoped>
@import "~/resources/sass/_deliveboo.scss";
    
footer{
    background-color: #303030;
    height: 180px;
    // margin-top: 50px;
    display: flex;
    align-items: center;
    
    .link-cont {
        height: 100%;
        width: 33.3%;
        display: flex;
        align-items: center;
        justify-content: center;
        
        div{

            a {
                width: 100%;
    
                img{
                    width: 50%;
                }
            }    
        }
        
    }
    .scritta{
        width: 33.3%;
        text-align: center;

        p {
            font-weight: bold;
            font-size: 1.3rem;
            color: var(--primary-color);
            padding-top: 20px;
        }
    }

    .links {
        width: 33.3%;
        display: flex;
        align-items: center;
        justify-content: center;

        a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
            font-size: 1.3rem;
            margin-right: 20px;
        }
        ul{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    }
    
}

@media screen and (max-width: 768px){
    footer{
        height: min-content;
        flex-direction: column;
        padding-bottom: 10px;

        .link-cont{
            width: inherit;
            text-align: center;
        }

        .scritta{
            width: inherit;
        }

        .links{
            width: inherit;
        }
    }
}
</style>