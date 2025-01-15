import argparse


def main():
    pass


if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="Manage Tasks")
    parser.add_argument("add", metavar="str", nargs="+", type=str, help="add a task")

    parser.add_argument("list", metavar="None", help="List all task")
    parser.exit(0)
    main()
