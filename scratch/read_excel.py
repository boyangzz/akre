import openpyxl
import sys

def read_excel(file_path):
    try:
        wb = openpyxl.load_workbook(file_path)
        sheet = wb.active
        for row in sheet.iter_rows(values_only=True):
            print("\t".join([str(cell) if cell is not None else "" for cell in row]))
    except Exception as e:
        print(f"Error: {e}")

if __name__ == "__main__":
    read_excel(sys.argv[1])
