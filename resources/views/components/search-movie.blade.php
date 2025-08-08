<style>
    .search-container {
        width: 100%;
        margin: 20px auto;
    }

    .search-form {
        display: flex;
        background: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 12px;
        overflow: hidden;
        transition: border-color 0.3s ease;
    }

    .search-form:focus-within {
        border-color: #3498db;
    }

    .search-input {
        flex-grow: 1;
        padding: 12px 16px;
        border: none;
        outline: none;
        font-size: 1rem;
        background-color: transparent;
        color: #333;
    }

    .search-input::placeholder {
        color: #aaa;
        font-weight: 300;
    }

    .search-button {
        background: none;
        border: none;
        padding: 0 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }



    .search-button svg {
        width: 20px;
        height: 20px;
    }

    @media (max-width: 576px) {
        .search-input {
            font-size: 0.9rem;
        }

        .search-button svg {
            width: 18px;
            height: 18px;
        }
    }
</style>

<div class="search-container">
    <form method="GET" action="{{ route('user.video.player') }}" class="search-form">
        <input type="search" name="q" value="{{ request('q') }}" placeholder="جستجوی ویدیو..." class="search-input">
        <button type="submit" class="search-button" aria-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
              </svg>
        </button>
    </form>
</div>
