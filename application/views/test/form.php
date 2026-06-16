<style>
    :root {
        --primary-neon: #00f2ff;
        --secondary-neon: #7000ff;
        --bg-dark: #0f172a;
        --card-bg: rgba(255, 255, 255, 0.05);
    }

    body {
        background-color: var(--bg-dark);
        font-family: 'Segoe UI', sans-serif;
        color: white;
    }

    table {
        border-collapse: separate;
        border-spacing: 8px;
        /* Jarak antara kotak */
        margin: 50px auto;
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    th,
    td {
        width: 120px;
        height: 100px;
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    /* Tajuk Hari */
    .header-day {
        background: linear-gradient(45deg, var(--primary-neon), var(--secondary-neon));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 2px;
        border: none;
    }

    /* Kotak Ada Data (Kambing) */
    .day-active {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--primary-neon);
        font-weight: 600;
        cursor: pointer;
    }

    .day-active:hover {
        transform: translateY(-5px) scale(1.05);
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 20px rgba(0, 242, 255, 0.3);
        border-color: var(--primary-neon);
    }

    /* Kotak Kosong (Black Hole) */
    .day-empty {
        background: rgba(0, 0, 0, 0.3);
        border: 1px dashed rgba(255, 255, 255, 0.05);
    }

    /* Animasi Kambing */
    .kambing-text {
        font-size: 0.9rem;
        text-shadow: 0 0 10px var(--primary-neon);
    }
</style>

<table>
    <thead>
        <tr>
            <th class="header-day">Isnin</th>
            <th class="header-day">Selasa</th>
            <th class="header-day">Rabu</th>
            <th class="header-day">Khamis</th>
            <th class="header-day">Jumaat</th>
            <th class="header-day">Sabtu</th>
            <th class="header-day">Ahad</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $k => $v) { ?>
            <tr>
                <?php for ($i = 1; $i <= 7; $i++) {
                    if (isset($v[$i]) && $v[$i] != '') { ?>
                        <td class="day-active">
                            <span class="kambing-text">🐐 Kambing</span>
                            <div style="font-size: 10px; color: #64748b; margin-top: 5px;">
                                ID:
                                <?php echo $v[$i]; ?>
                            </div>
                        </td>
                    <?php } else { ?>
                        <td class="day-empty"></td>
                    <?php }
                } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>