import os, sys, time, json, requests
import shutil
origin = "http://172.16.1.91:3000" #your origin here

def main():
    # Get the list of files from the origin
    data = requests.get(f"{origin}/origin.php")
    file_list = data.json()
    print(file_list)

    # Download files and save them to pub
    for file in file_list:
        # Validate file
        if file in [".", ".."]:
            continue

        # Request file directly with streaming enabled
        data = requests.get(f"{origin}/public/{file}", stream=True)

        # Save to file
        if data.status_code == 200:
            os.makedirs("./public", exist_ok=True)  # Ensure the directory exists
            with open(f"./public/{file}", 'wb') as f:
                shutil.copyfileobj(data.raw, f)
        else:
            print(f"Failed to download {file}: HTTP {data.status_code}")

        print(f"Downloaded: {origin}/public/{file}")

    return

if __name__ == "__main__":
    main()
