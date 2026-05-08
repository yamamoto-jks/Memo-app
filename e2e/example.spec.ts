import { test, expect } from "@playwright/test";

// TODO: テスト用のDBを用いる

test("メモ新規作成ページにて、未入力の場合、送信時にエラーが出てくること", async ({
    page,
}) => {
    await page.goto("/new");

    await expect(page.getByRole("heading", { name: /新規作成/ })).toBeVisible();

    await page.getByRole("button").click();

    await expect(page.getByRole("alert")).toHaveText(/メモを入力してください/);
});

test("新規作成ページにて、正しく入力して作成した場合、一覧ページにて作成済みのタスクが見えるかつ、作成成功の文言も表示されること", async ({
    page,
}) => {
    await page.goto("/new");

    await expect(page.getByRole("heading", { name: /新規作成/ })).toBeVisible();

    const taskName = "テストタスク_" + Date.now();
    await page.getByRole("textbox").fill(taskName);
    await page.getByRole("button").click();

    await expect(page).toHaveURL("/");
    await expect(page.getByText(/保存に成功しました。/)).toBeVisible();
    await expect(page.getByText(taskName)).toBeVisible();
});
