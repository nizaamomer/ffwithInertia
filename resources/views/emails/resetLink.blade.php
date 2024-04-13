<div
style="
    width: 80%;
    background-color: #4c51bf;
    border-radius: 0.5rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    border-color: #718096;
    margin-top: 0;
    max-width: 28rem;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
"
>
<div
    style="
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        padding: 2rem;
    "
>
    <h1
        style="
            font-size: 0.875rem;
            line-height: 1.25;
            letter-spacing: -0.025em;
            color: #e2e8f0;
            font-size: 1.5rem;
            color: #cbd5e0;
        "
    >
        سڵاو لە بڕۆینەوە <br /><br />
        <span style="color: #e2e8f0; font-size: 1.25rem"
            >ئەم لینکە بکەوە بۆ گۆڕینی وشەی نهێنیەکەت....</span
        >
    </h1>

    <div style="display: flex; justify-content: space-between"></div>
    <a
        href="{{ url('/reset-password/' . $token) }}"
        style="
            width: 100%;
            color: #fff;
            font-size: 1.125rem;
            background-color: #2f855a;
            padding: 0.625rem 1.25rem;
            text-align: center;
            text-decoration: none;
            display: block;
            font-weight: 500;
            border-radius: 0.375rem;
        "
    >
        گــۆڕین
    </a>
</div>
</div>