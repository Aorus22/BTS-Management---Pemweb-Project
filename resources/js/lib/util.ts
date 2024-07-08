import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';
import ExcelJS from 'exceljs';

export const exportToPdf = (data: Array<{ [key: string]: any }>) => {
    const doc = new jsPDF('p', 'pt', 'a4');
    const pdfTable = document.querySelector('#pdf-table') as HTMLTableElement;

    if (!pdfTable) {
        console.error('Element with ID "pdf-table" not found.');
        return;
    }

    const actionColumns = pdfTable.querySelectorAll('th:last-child, td:last-child') as NodeListOf<HTMLElement>;
    actionColumns.forEach(col => {
        col.style.display = 'none';
    });

    const totalPagesExpander = new Promise<void>(resolve => {
        const pdfWidth = doc.internal.pageSize.getWidth();
        const pdfHeight = doc.internal.pageSize.getHeight();
        html2canvas(pdfTable, {
            scale: 1
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const imgHeight = (canvas.height * pdfWidth) / canvas.width;
            let position = 0;

            // Calculate total pages
            const totalRows = pdfTable.rows.length;
            const pageHeight = pdfHeight - 40; // accounting for margins

            const renderPage = () => {
                doc.addImage(imgData, 'PNG', 40, 40 + position, pdfWidth - 80, imgHeight);
                position -= pageHeight;

                // Check if there are remaining rows to render
                if (position <= -imgHeight) {
                    doc.addPage();
                    resolve();
                } else {
                    doc.addPage();
                    renderPage();
                }
            };

            renderPage();
        });
    });

    totalPagesExpander.then(() => {
        actionColumns.forEach(col => {
            col.style.display = '';
        });

        doc.save('table.pdf');
    }).catch(error => {
        console.error('Failed to generate PDF:', error);
        actionColumns.forEach(col => {
            col.style.display = '';
        });
    });
};

export const exportToExcel = (data: Array<{ [key: string]: any }>) => {
    const workbook = new ExcelJS.Workbook();
    const sheet = workbook.addWorksheet('Sheet1');

    const headers = Object.keys(data[0]);
    sheet.addRow(headers);

    data.forEach(item => {
        const row = Object.values(item);
        sheet.addRow(row);
    });

    workbook.xlsx.writeBuffer().then(buffer => {
        const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        const filename = 'table.xlsx';
        const href = URL.createObjectURL(blob);

        const a = document.createElement('a');
        a.href = href;
        a.download = filename;
        a.click();
        URL.revokeObjectURL(href);
    });
};
