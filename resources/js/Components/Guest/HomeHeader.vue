<template>

    <!-- <nav v-if="canLogin">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
            >
                Dashboard
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                >
                    Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                >
                    Register
                </Link>
            </template>
    </nav> -->

    <header>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="top-line">
              <div class="burger">
                <svg width="27" height="15" viewBox="0 0 27 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 1.5H26" stroke="#252525" stroke-width="2" stroke-linecap="round"/>
                  <path d="M1 7.5H26" stroke="#252525" stroke-width="2" stroke-linecap="round"/>
                  <path d="M1 13.5H26" stroke="#252525" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </div>
              <div class="hello">Напиши нам 👋</div>
            </div>
          </div>
        </div>
      </div>
    </header>
</template>

<style scoped lang="scss">

header {
  padding: 10px 0;
  .top-line {
    padding: 24px 28px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    .hello {
      font-weight: 400;
      font-size: 14px;
      line-height: 120%;
      color: #252525;
    }
  }
}

</style>