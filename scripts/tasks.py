# scripts/tasks.py
import sys
import json
from datetime import datetime
import os

TASK_FILE = os.path.join(os.path.dirname(__file__), 'tasks.json')

def load_tasks():
    try:
        with open(TASK_FILE, 'r') as f:
            return json.load(f)
    except FileNotFoundError:
        return []

def save_tasks(tasks):
    with open(TASK_FILE, 'w') as f:
        json.dump(tasks, f, indent=4)

def add_task(task):
    tasks = load_tasks()
    time_now = datetime.now().strftime("%H:%M")
    task_obj = {
        "task": task,
        "time": time_now
    }
    tasks.append(task_obj)
    save_tasks(tasks)
    print(json.dumps({"message": f"Task '{task}' added at {time_now}."}))

def get_tasks():
    tasks = load_tasks()
    print(json.dumps(tasks))

if __name__ == '__main__':
    if len(sys.argv) >= 2:
        command = sys.argv[1]
        if command == 'add' and len(sys.argv) >= 3:
            task = sys.argv[2]
            add_task(task)
        elif command == 'get':
            get_tasks()
        else:
            print(json.dumps({"error": "Invalid command"}))
