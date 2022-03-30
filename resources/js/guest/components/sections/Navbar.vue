<template>
    <nav>
        <div class="logo">
          <img src="img/deliveboo_logo_viola.png" alt="Deliveboo Logo">
        </div>
        <div class="search">
            <a href="/admin/home">
                <button>Area personale</button>
            </a>
        </div>
    </nav>
</template>

<script>
import axios from "axios"
export default {
    name: 'Navbar',

}
</script>

<style lang="scss" scoped>
nav {
    height: 100px;
    background: #cfea98; 
    display: flex;
    justify-content: space-between;
    align-items: center;

    img {
        width: 12.5rem;
    }

    .search {
        display: flex;
        margin-right: 1rem;
        * {
            font-size: 1rem;
            line-height: 2rem;
            padding: 5px 20px;
            border-radius: 30px;
            border: none;
        }
        
        input {
            margin-right: 10px;
            width: 100%;
        }

        button {
            font-weight: bold;
            border: 2px solid #3e075f;
            background-color: transparent;
            // color: #37b9b4;
            color: #3e075f;
            transition: all .1s ease;
            cursor: pointer;
            &:active {
                background-color: #3e075f;
                color: white;
            }
        }
    }
}

button:hover{
    scale:1.1;
    transition:1s;
}
</style>