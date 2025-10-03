    const deleteCommentModal = document.getElementById("deleteCommentModal");
    const closeDeleteCommentModal = document.getElementById("closeDeleteCommentModal");
    const deleteReportId = document.getElementById("deleteReportId");
    const deleteCommentId = document.getElementById("deleteCommentId");
    const deleteCommentName = document.getElementById("deleteCommentName");

    const blockUserModal = document.getElementById("blockUserModal");
    const closeBlockUserModal = document.getElementById("closeBlockUserModal");
    const blockUserId = document.getElementById("blockUserId");
    const blockUserName = document.getElementById("blockUserName");

    const RemoveReportModal = document.getElementById("RemoveReportModal");
    const closeRemoveReportModal = document.getElementById("closeRemoveReportModal");
    const RemoveReportId = document.getElementById("RemoveReportId");
    const RemoveReportUserName = document.getElementById("RemoveReportUserName");

    document.querySelectorAll(".open-delete").forEach(btn => {
        btn.addEventListener("click", () => {
            const report_id = btn.getAttribute("data-report-id");
            const comment_id = btn.getAttribute("data-comment-id");
            const name = btn.getAttribute("data-name");

            deleteReportId.value = report_id;
            deleteCommentId.value = comment_id;
            deleteCommentName.textContent = name;
            deleteCommentModal.classList.remove("hidden");
        });
    });

    closeDeleteCommentModal.addEventListener("click", () => {
        deleteCommentModal.classList.add("hidden");
    });

    document.querySelectorAll(".open-block").forEach(btn => {
        btn.addEventListener("click", () => {
            const user_id = btn.getAttribute("data-reported-user-id");
            const name = btn.getAttribute("data-reported-user-name");

            blockUserId.value = user_id;
            blockUserName.textContent = name;
            blockUserModal.classList.remove("hidden");
        });
    });

    closeBlockUserModal.addEventListener("click", () => {
        blockUserModal.classList.add("hidden");
    });

    document.querySelectorAll(".open-remove").forEach(btn => {
        btn.addEventListener("click", () => {
            const report_id = btn.getAttribute("data-report-id");
            const name = btn.getAttribute("data-name-admin");

            RemoveReportId.value = report_id;
            RemoveReportUserName.textContent = name;
            RemoveReportModal.classList.remove("hidden");
        });
    });

    closeRemoveReportModal.addEventListener("click", () => {
        RemoveReportModal.classList.add("hidden");
    });