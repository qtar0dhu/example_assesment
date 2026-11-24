<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>出品</title>
</head>
<body>
    <h1>商品出品</h1>
    <form action="newproduct_data.php" method="POST" enctype="multipart/form-data">
        <div>
            <label>商品名: <input type="text" name="name" required></label>
        </div>
        <div>
            <label>金額: <input type="number" name="price" required></label>
        </div>
        <div>
            <label>カテゴリー: 
                <select name="category" required>
                    <option value="必修">必修科目教科書</option>
                    <option value="参考書">参考書</option>
                    <option value="画材">画材</option>
                    <option value="デバイス">デバイス</option>
                    <option value="古着">古着</option>
                    <option value="アクセサリー">アクセサリー</option>
                    <option value="グッズ">グッズ</option>
                    <option value="ゲーム">ゲーム</option>
                    <option value="書籍">書籍</option>
                    <option value="その他">その他</option>
                </select>
            </label>
        </div>
        <div>
            <label>説明文: <textarea name="description" required></textarea></label>
        </div>
        <div>
            <label>写真: <input type="file" name="image" accept="image/*" required></label>
        </div>
        <button type="submit">出品</button>
    </form>
</body>
</html>
